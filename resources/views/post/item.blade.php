<div class="post">
    <div class="post-date">
        {{$post->date->formatLocalized('%d %B %Y')}}, в {{$post->date->formatLocalized('%H:%M')}}
    </div>
    @if(!empty($post->text) && strlen($post->text) > 10)
        <div class="post-text">{!! $post->text !!}</div>
    @endif
    @if($post->attachments->count() > 0)
        <div class="post-media">@include('post.attachments', ['attachments' => $post->attachments, 'post' => $post])</div>
    @endif
</div>