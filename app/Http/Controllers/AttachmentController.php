<?php namespace App\Http\Controllers;

use App\Attachment;
use App\Integration\Services\Vk;
use Request;
use Input;

class AttachmentController extends Controller {

    /**
     * @return \Response
     */
    public function show() {
        $result = [];
        $type = Input::get('type', null);
        $id = Input::get('id', null);
        $postId = Input::get('post', null);
        $albumId = Input::get('album', null);

        $attachment = Attachment::where(['id' => $id, 'type' => $type])->firstOrFail();

        $result['attachment'] = [
            'type' => $attachment->type
        ];
        $result['before'] = [];
        $result['after'] = [];

        switch($attachment->type) {
            case 'photo':
                $result['attachment']['src'] = $attachment->srcs['src_big'];
                break;
            case 'video':
                $result['attachment']['player'] = $attachment->srcs['player'];
                break;
        }

        if ($albumId) {
            $album = Attachment::find($albumId);
            $other_photos = $album->childs()->where('child_attachment_id', '<>', $attachment->id)->get();

            $result['album'] = ['title' => $album->title];
            foreach($other_photos as $photo) {
                $result[($photo->id > $attachment->id) ? 'after' : 'before'][] = [
                    'type' => $photo->type,
                    'src' => $photo->srcs['src_big'],
                    'url' => route('attachment_show', [
                        'id' => $photo->id,
                        'type' => 'photo',
                        'album' => $album->id,
                        'post' => $postId
                    ])
                ];
            }
        }

        return view('post.attachments.show', $result);
    }

    /**
     * @param $vid
     * @return \Response
     * @throws \Exception
     */
    public function loadVideo($vid) {
        $attachment = Attachment::findOrFail($vid);

        $response = Vk::call('video.get', [
            'videos' => $attachment->external_id
        ]);

        $video = $response['response'][1];

        return response()->json([
            'title' => $video['title'],
            'description' => text_linked($video['description']),
            'player' => $video['player']
        ]);
    }

    /**
     * @param $aid
     * @return \Response
     * @throws \Exception
     */
    public function loadAudio($aid) {
        $attachment = Attachment::findOrFail($aid);

        $response = Vk::call('audio.getById', [
            'audios' => $attachment->external_id
        ]);

        $audio = reset($response['response']);

        return response()->json([
            'url' => $audio['url']
        ]);
    }
}