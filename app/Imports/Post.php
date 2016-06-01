<?php namespace App\Imports;

use App\Attachment;
use App\Integration\Services\Vk;
use App\Option;
use App\Post as PostModel;
use Carbon\Carbon;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;

class Post {

    /**
     * @var int
     */
    protected static $__count_imports_posts = 0;

    /**
     * @var int
     */
    protected static $__count_imports_new_posts = 0;

    /**
     * @var int
     */
    protected static $__count_imports_attachments = 0;

    /**
     * @var int
     */
    protected static $__count_imports_new_attachments = 0;

    /**
     * @param int $offset
     * @param int $count
     * @return array
     * @throws \Exception
     */
    public static function import($offset = 0, $count = 20) {
        $response = Vk::call('wall.get', [
            'owner_id' => '-' . Option::get('vk-group-id'),
            'offset' => $offset,
            'count' => $count,
            'filter' => 'owner',
            'extended' => 0
        ]);

        $response = $response['response'];
        $allPosts = $response[0];

        $posts = [];

        foreach($response as $respond) {
            if (!is_array($respond)) continue;
            if (isset($respond['is_pinned']) && $respond['is_pinned'] == 1) continue;
            array_push($posts, $respond);
        }

        self::resetCounter();
        $normalize_posts = array_map([__CLASS__, 'normalize'], $posts);

        Option::set('vk-group-last-update-date', time());
        Option::set('vk-posts-count', $allPosts);
        return [
            'offset' => $offset,
            'count' => $count,
            'counts' => [
                'all' => $allPosts,
                'posts' => self::$__count_imports_posts,
                'new_posts' => self::$__count_imports_new_posts,
                'attachments' => self::$__count_imports_attachments,
                'new_attachments' => self::$__count_imports_new_attachments
            ]
        ];
    }

    /**
     * Очищает счетчик импорта.
     * 
     * @return void
     */
    public static function resetCounter() {
        self::$__count_imports_posts = 0;
        self::$__count_imports_new_posts = 0;
        self::$__count_imports_attachments = 0;
        self::$__count_imports_new_attachments = 0;
    }

    /**
     * @param $postData
     * @return mixed
     */
    public static function normalize(&$postData) {
        $postId = sprintf('%d_%d', $postData['from_id'], $postData['id']);

        $post = PostModel::firstOrNew(['external_id' => $postId]);

        self::$__count_imports_posts++;
        if (!$post->id) {
            self::$__count_imports_new_posts++;
        }

        $text = '';

        if ($postData['post_type'] == 'copy') {
            $text = isset($postData['copy_text']) && !empty($postData['copy_text']) ? $postData['copy_text'] : '';
        }

        $text .= !empty($text) && !empty($postData['text']) ? '<br>' : '';
        $text .= !empty($postData['text']) ? $postData['text'] : '';

        $post->date = Carbon::createFromTimestamp($postData['date']);
        $post->text = $text;
        $post->save();

//        dump($text, $post->text);

        if (isset($postData['attachments'])) {
            $attachments = self::attachmentsPost($postData['attachments']);

            if (sizeof($attachments) > 0) {
                $post->attachments()->sync($attachments, false);
            }
        }


        return $post;
    }

    /**
     * @param array $attachmentsData
     * @return array
     */
    public static function attachmentsPost($attachmentsData = []) {
        $attachments = [];

        foreach($attachmentsData as $attachmentData) {
            $attachments[] = self::_prepareAttachment($attachmentData);
        }

        $attachments = self::createAttachments($attachments);

        return $attachments;
    }

    /**
     * @param array $attachments
     * @return array
     */
    public static function createAttachments($attachments) {
        $attachs = [];
        foreach($attachments as $attachData) {
            $attach = self::__getAttachment($attachData);

            self::$__count_imports_attachments++;
            if (!$attach->id) {
                self::$__count_imports_new_attachments++;
            }

            foreach($attachData as $key => $value) {
                if ($key === 'id' || $key === 'type') continue;
                if ($key === 'photos') continue;
                if ($key === 'date') continue;
                $attach->{$key} = $value;
            }

            $attach->save();
            $attachs[] = $attach->id;

            if ($attachData['type'] === 'album' && isset($attachData['photos']) && sizeof($attachData['photos']) > 0) {
                $photos = self::createAttachments($attachData['photos']);

                if (sizeof($photos) > 0) {
                    $attach->childs()->sync($photos, false);
                }
            }
        }

        return $attachs;
    }

    /**
     * @param array $data
     * @return Attachment|\Illuminate\Database\Eloquent\Model|null|static
     */
    protected static function __getAttachment(array $data = []) {
        $atatch = null;
        $whereParam = [
            'external_id' => $data['id'],
            'type' => $data['type']
        ];

        switch($data['type']) {
            case 'link':
                $url = $data['srcs']['url'];
                $url = str_replace('/', '\\\\/', $url);
                $attach = Attachment::where('srcs', 'like', '%' . $url . '%')
                    ->where('type', $data['type'])->first();

                if (is_null($attach)) {
                    $attach = new Attachment($whereParam);
                }
            break;

            default:
                $attach = Attachment::firstOrNew($whereParam);
            break;
        }

        return $attach;
    }

    /**
     * @param array $attachmentData
     * @return  array
     */
    protected static function _prepareAttachment($attachmentData = []) {
        $data = [
            'id' => '',
            'type' => '',
            'title' => '',
            'description' => '',
            'srcs' => '',
            'date' => null,
            'access_key' => ''
        ];

        switch($attachmentData['type']) {
            case 'photo':
                self::_prepareAttachmentPhoto($attachmentData, $data);
                break;
            case 'video':
                self::_prepareAttachmentVideo($attachmentData, $data);
                break;
            case 'audio':
                self::_prepareAttachmentAudio($attachmentData, $data);
                break;
            case 'album':
                self::_prepareAttachmentAlbum($attachmentData, $data);
                self::__albumLoadPhotos($data);
                break;
            case 'link':
                self::_prepareAttachmentLink($attachmentData, $data);
                break;
            case 'poll':
                self::_prepareAttachmentPoll($attachmentData, $data);
                break;
        }

        return $data;
    }

    /**
     * @param $attachmentData
     * @param $data
     */
    protected static function _prepareAttachmentPhoto($attachmentData, &$data) {
        $photoData = $attachmentData['photo'];

        $data['type'] = $attachmentData['type'];
        $data['id'] = $photoData['owner_id'] . '_' . $photoData['pid'];
        $data['date'] = $photoData['created'];
        $data['description'] = $photoData['text'];
        $data['srcs'] = [];

        if (isset($photoData['access_key'])) {
            $data['access_key'] = $photoData['access_key'];
        }

        if (isset($photoData['src'])) {
            $data['srcs']['image'] = $photoData['src'];
        }

        if (isset($photoData['src_big'])) {
            $data['srcs']['image_big'] = $photoData['src_big'];
        }

        if (isset($photoData['src_small'])) {
            $data['srcs']['image_small'] = $photoData['src_small'];
        }
    }

    /**
     * @param $attachmentData
     * @param $data
     */
    protected static function _prepareAttachmentVideo($attachmentData, &$data) {
        $videoData = $attachmentData['video'];

        $data['type'] = $attachmentData['type'];
        $data['id'] = $videoData['owner_id'] . '_' . $videoData['vid'];
        $data['date'] = $videoData['date'];
        $data['title'] = $videoData['title'];
        $data['srcs'] = [];

        if (isset($photoData['access_key'])) {
            $data['access_key'] = $videoData['access_key'];
        }

        if (isset($videoData['image'])) {
            $data['srcs']['image'] = $videoData['image'];
        }

        if (isset($videoData['image_big'])) {
            $data['srcs']['image_big'] = $videoData['image_big'];
        }

        if (isset($videoData['image_small'])) {
            $data['srcs']['image_small'] = $videoData['image_small'];
        }
    }

    /**
     * @param $attachmentData
     * @param $data
     */
    protected static function _prepareAttachmentAudio($attachmentData, &$data) {
        $audioData = $attachmentData['audio'];

        $data['type'] = $attachmentData['type'];
        $data['id'] = $audioData['owner_id'] . '_' . $audioData['aid'];
        $data['title'] = $audioData['artist'];
        $data['description'] = $audioData['title'];
        $data['srcs'] = [];

        $data['srcs']['url'] = $audioData['url'];
        $data['srcs']['duration'] = $audioData['duration'];
    }

    /**
     * @param $attachmentData
     * @param $data
     */
    protected static function _prepareAttachmentAlbum($attachmentData, &$data) {
        $albumData = $attachmentData['album'];

        $data['type'] = $attachmentData['type'];
        $data['id'] = $albumData['owner_id'] . '_' . $albumData['aid'];
        $data['title'] = $albumData['title'];
        $data['description'] = $albumData['description'];
        $data['date'] = $albumData['created'];
        $data['srcs'] = [];

        $data['srcs']['updated'] = $albumData['updated'];
        $data['srcs']['thumb_id'] = $albumData['thumb']['owner_id'] . '_' . $albumData['thumb']['pid'];
    }

    /**
     * @param $attachmentData
     * @param $data
     */
    protected static function _prepareAttachmentLink($attachmentData, &$data) {
        $linkData = $attachmentData['link'];

        $data['id'] = uniqid('link-');
        $data['type'] = $attachmentData['type'];
        $data['title'] = $linkData['title'];
        $data['description'] = $linkData['description'];
        $data['srcs'] = [];

        $data['srcs']['url'] = $linkData['url'];

        if (isset($linkData['image_src'])) {
            $data['srcs']['image'] = $linkData['image_src'];
            $data['srcs']['image_big'] = $linkData['image_src'];
            $data['srcs']['image_small'] = $linkData['image_src'];
        }
    }

    /**
     * @param $attachmentData
     * @param $data
     */
    protected static function _prepareAttachmentPoll($attachmentData, &$data) {
        $pollData = $attachmentData['poll'];

        $data['type'] = $attachmentData['type'];
        $data['id'] = Option::get('vk-group-id') . '_' . $pollData['poll_id'];
        $data['title'] = 'В записи имеется голосование, подробности смотрите в источнике.';
    }

    /**
     * @param $data
     */
    protected static function __albumLoadPhotos(&$data) {
        list($owner_id, $album_id) = explode('_', $data['id']);

        if (!isset($owner_id) && empty($owner_id) && !isset($album_id) && empty($album_id)) {
            throw new InvalidArgumentException('Не удалось получить идентификатор альбома');
        }

        $response = Vk::call('photos.get', [
            'owner_id' => $owner_id,
            'album_id' => $album_id
        ]);

        $response = $response['response'];
        $photos = [];

        foreach($response as $photo) {
            $photos[] = self::_prepareAttachment([
                'type' => 'photo',
                'photo' => $photo
            ]);
        }

        $data['photos'] = $photos;
    }
}