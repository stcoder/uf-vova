<?php namespace App\Http\Controllers\Admin;

use Admin;
use App\Attachment;
use App\Http\Controllers\Controller;
use App\Integration\Services\Vk;
use App\Option;
use App\Post;
use Carbon\Carbon;

class Imports extends Controller
{
    public function main() {
        $data = ['posts' => [], 'reviews' => []];
        $display = view('admin.integration.imports.dashboard', $data)->render();
        return Admin::view($display, 'Импорт');
    }
    
    public function posts() {
        $data = [
            'group' => [
                'id' => Option::get('vk-group-id'),
                'name' => Option::get('vk-group-name'),
                'photo' => Option::get('vk-group-photo'),
                'integrated-date' => Carbon::createFromTimestamp(Option::get('vk-group-integrated-date'))
            ]
        ];

        if (Option::has('vk-group-updated-date')) {
            $data['group']['updated-date'] = Carbon::createFromTimestamp(Option::get('vk-group-updated-date'));
        }

        $posts = Post::where('deleted_at', '=', null)->paginate(6);
        $data['posts'] = $posts;
        $display = view('admin.integration.imports.posts', $data)->render();
        return Admin::view($display, 'Записи со стены');
    }

    public function postsImport() {
        $start = Carbon::now();
        $stats = \App\Imports\Post::import(620, 5);
        $stop = Carbon::now();

        $stats['time'] = $start->diffForHumans($stop, true);

        $content = view('admin.integration.imports.posts-success', $stats)->render();
        return Admin::view($content, 'Импорт завершен');
    }

    /**
     * @param array $postRaw
     * @return \App\Post
     */
    protected function __normalizePosts(&$postRaw) {
        $postId = sprintf('%d_%d', $postRaw['from_id'], $postRaw['id']);

        $post = Post::firstOrNew(['external_id' => $postId]);
        $post->date = Carbon::createFromTimestamp($postRaw['date']);
        $post->text = $postRaw['text'];
        $post->save();

        $attachments = $this->__attachmentsPost($postRaw['attachments']);

        if (sizeof($attachments) > 0) {
            $post->attachments()->sync($attachments, false);
        }
        return $post;
    }

    /**
     * @param array $attachmentsRaw
     * @return array
     */
    public function __attachmentsPost($attachmentsRaw) {
        $attachments = [];
        $videoIds = [];
        $albumIds = [];
        $attachmentsRaw = array_map(function($attachmentRaw) use(&$videoIds, &$albumIds) {
            $id = null;
            $title = '';
            $description = '';
            $srcs = '';
            $date = null;
            $access_key = '';
            switch($attachmentRaw['type']) {
                case 'photo':
                    $id = sprintf('%s_%s',
                        $attachmentRaw['photo']['owner_id'],
                        $attachmentRaw['photo']['pid']
                    );
                    $access_key = $attachmentRaw['photo']['access_key'];
                    $date = $attachmentRaw['photo']['created'];
                    $description = $attachmentRaw['photo']['text'];
                    $srcs = [
                        'src' => $attachmentRaw['photo']['src'],
                        'src_big' => $attachmentRaw['photo']['src_big']
                    ];
                    break;
                case 'video':
                    $id = sprintf('%s_%s',
                        $attachmentRaw['video']['owner_id'],
                        $attachmentRaw['video']['vid']
                    );
                    $access_key = $attachmentRaw['video']['access_key'];
                    $date = $attachmentRaw['video']['date'];
                    $title = $attachmentRaw['video']['title'];
                    $description = $attachmentRaw['video']['description'];
                    $srcs = [
                        'image' => $attachmentRaw['video']['image'],
                        'image_big' => $attachmentRaw['video']['image_big']
                    ];
                    array_push($videoIds, $id . '_' . $access_key);
                    break;
                case 'audio':
                    $id = sprintf('%s_%s',
                        $attachmentRaw['audio']['owner_id'],
                        $attachmentRaw['audio']['aid']
                    );
                    $title = $attachmentRaw['audio']['artist'];
                    $description = $attachmentRaw['audio']['title'];
                    $srcs = [
                        'url' => $attachmentRaw['audio']['url'],
                        'duration' => $attachmentRaw['audio']['duration']
                    ];
                    break;
                case 'album':
                    $id = sprintf('%s_%s',
                        $attachmentRaw['album']['owner_id'],
                        $attachmentRaw['album']['aid']
                    );
                    $title = $attachmentRaw['album']['title'];
                    $description = $attachmentRaw['album']['description'];
                    $date = $attachmentRaw['album']['created'];
                    $srcs = [
                        'updated' => $attachmentRaw['album']['updated'],
                        'thumb' => [
                            'src' => $attachmentRaw['album']['thumb']['src'],
                            'src_big' => $attachmentRaw['album']['thumb']['src_big']
                        ]
                    ];
                    array_push($albumIds, $id);
                break;
            }

            if (is_null($id)) {
                return null;
            }

            return [
                'id' => $id,
                'type' => $attachmentRaw['type'],
                'title' => $title,
                'description' => $description,
                'date' => $date,
                'srcs' => $srcs,
                'access_key' => $access_key
            ];
        }, $attachmentsRaw);

        if (sizeof($videoIds) > 0) {
            $videosResponse = Vk::call('video.get', [
                'videos' => implode(',', $videoIds)
            ]);

            $videos = array_slice($videosResponse['response'], 1);
            foreach($videos as $video) {
                $id = $video['owner_id'] . '_' . $video['vid'];
                $index = array_search($id, array_column($attachmentsRaw, 'id'));

                if (is_bool($index) && $index === false) {
                    continue;
                }

                $attachmentsRaw[$index]['srcs']['player'] = $video['player'];
            }
        }

        if (sizeof($albumIds) > 0) {
            foreach($albumIds as $albumId) {
                $part = explode('_', $albumId);
                $owner_id = $part[0];
                $album_id = $part[1];

                $index = array_search($albumId, array_column($attachmentsRaw, 'id'));

                if (is_bool($index) && $index === false) {
                    continue;
                }

                $photosResponse = Vk::call('photos.get', [
                    'owner_id' => $owner_id,
                    'album_id' => $album_id
                ]);

                $photos = array_slice($photosResponse['response'], 1);

                $normalizePhotos = [];
                foreach($photos as $photo) {
                    $normalizePhotos[] = [
                        'external_id' => $photo['owner_id'] . '_' . $photo['pid'],
                        'srcs' => [
                            'src' => $photo['src'],
                            'src_big' => $photo['src_big']
                        ],
                        'description' => $photo['text']
                    ];
                }

                $attachmentsRaw[$index]['photos'] = $normalizePhotos;
            }
        }

        $attachments = array_map(function($attachmentRaw) {
            if (is_null($attachmentRaw)) {
                return null;
            }
            $attachmentRaw['external_id'] = $attachmentRaw['id'];
            unset($attachmentRaw['id']);

            $attachment = Attachment::firstOrNew([
                'external_id' => $attachmentRaw['external_id'],
                'type' => $attachmentRaw['type']
            ]);
            $attachment->access_key = $attachmentRaw['access_key'];
            $attachment->title = $attachmentRaw['title'];
            $attachment->description = $attachmentRaw['description'];
            $attachment->srcs = $attachmentRaw['srcs'];
            $attachment->save();

            if ($attachmentRaw['type'] === 'album' && isset($attachmentRaw['photos']) && sizeof($attachmentRaw['photos']) > 0) {
                $photoIds = [];
                foreach($attachmentRaw['photos'] as $photo) {
                    $attachmentPhoto = Attachment::firstOrNew([
                        'external_id' => $photo['external_id']
                    ]);
                    $attachmentPhoto->description = $photo['description'];
                    $attachmentPhoto->srcs = $photo['srcs'];
                    $attachmentPhoto->save();

                    array_push($photoIds, $attachmentPhoto->id);
                }

                if (sizeof($photoIds) > 0) {
                    $attachment->childs()->sync($photoIds, false);
                }
            }

            return $attachment->id;
        }, $attachmentsRaw);

        $attachments = array_filter($attachments, function($attachment) {
            return !is_null($attachment);
        });

        return $attachments;
    }
}