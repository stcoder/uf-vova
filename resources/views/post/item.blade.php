<div id="post-id-{{ $post->id }}" class="post">
    @if ($post->header_image)
        <div class="post-media">
            <div class="post-media-image" style="background-image: url({{ $post->header_image->thumbnail('preview-by-news') }})"></div>
        </div>
    @endif
    <div class="post-title">{{ $post->title }}</div>
    <div class="post-text">{{ $post->short_content }}</div>
    <div class="post-bottom">
        <div class="post-date">{{$post->published_at->formatLocalized('%d %B %Y')}}, в {{$post->published_at->formatLocalized('%H:%M')}}</div>
        <a href="{{ route('news', [
            'date' => $post->published_at->formatLocalized('%Y-%m-%d'),
            'slug' => $post->slug
        ]) }}" class="post-link">Подробней</a>
    </div>
</div>