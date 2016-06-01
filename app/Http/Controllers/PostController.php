<?php namespace App\Http\Controllers;

use App\Attachment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Integration\Services\Vk;
use App\Option;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

    /**
     * @param $pid
     * @return \Response
     */
    public function show($pid) {
        if (empty($pid) || is_null($pid)) {
            abort(404);
        }

        $post = Post::findOrFail($pid);
        $prevPost = Post::whereRaw('id = (select max(id) from posts where id < ' . $pid . ')')->limit(1)->orderBy('id', 'asc')->first();
        $nextPost = Post::whereRaw('id = (select min(id) from posts where id > ' . $pid . ')')->limit(1)->orderBy('id', 'asc')->first();

        $data = [
            'post' => $post,
            'photos' => [],
            'videos' => [],
            'links' => [],
            'audios' => [],
            'polls' => [],
            'prevPostUrl' => is_null($prevPost) ? null : route('post_show', ['pid' => $prevPost->id]),
            'nextPostUrl' => is_null($nextPost) ? null : route('post_show', ['pid' => $nextPost->id])
        ];

        if (!is_null($post->attachments)) {
            foreach($post->attachments as $attachment) {
                if ($attachment->type === 'album') {
                    $photos = $attachment->childs;

                    foreach($photos as $photo) {
                        array_push($data['photos'], $photo);
                    }

                    continue;
                }

                array_push($data[$attachment->type . 's'], $attachment);
            }
        }

        return view('post.post', $data);
    }
}
