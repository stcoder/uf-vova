<div id="post-id-{{ $post->id }}" class="post">
    @if ($post->getFirstImage())
        <div class="post-media">
            <div class="post-media-image" style="background-image: url({{ $post->getFirstImage() }})"></div>
        </div>
        <div class="post-text">{!! Str::words($post->text, 5) !!}</div>
    @else
        <div class="post-text">{!! Str::words($post->text, 80) !!}</div>
    @endif
    <div class="post-bottom">
        <div class="post-date">{{$post->date->formatLocalized('%d %B %Y')}}, в {{$post->date->formatLocalized('%H:%M')}}</div>
        <a href="{{ route('post_show', ['pid' => $post->id]) }}" class="post-link">Подробней</a>
    </div>
</div>