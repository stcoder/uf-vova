<div class="post-media-attachments c{{$attachments->count()}}">
    <div class="post-media-attachments-content">
        @foreach($attachments as $key => $attachment)
            @include('post.attachments.render', ['attachment' => $attachment, 'key' => $key, 'post' => $post])
        @endforeach
    </div>
</div>
