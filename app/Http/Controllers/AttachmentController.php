<?php namespace App\Http\Controllers;

use App\Attachment;
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
}