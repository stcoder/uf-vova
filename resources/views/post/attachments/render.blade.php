<div data-attachment-id="{{ $attachment->id }}" data-attachment-type="{{ $attachment->type }}" class="post-attachment post-attachment-{{ $attachment->type }} n{{$key}}">
    @if($attachment->type === 'photo')
        <a href="?show=modal&type={{$attachment->type}}&id={{$attachment->id}}&post={{$post->id}}" onclick="return showAttachment(this);" rel="nofollow">
            <img src="{{ $attachment->srcs['src_big'] }}" alt="{{ $attachment->title }}" class="img-rounded img-responsive">
        </a>
    @elseif($attachment->type === 'video')
        <a href="?show=modal&type={{$attachment->type}}&id={{$attachment->id}}&post={{$post->id}}" onclick="return showAttachment(this);" rel="nofollow" data-player="{{ $attachment->srcs['player'] }}">
            <img src="{{ $attachment->srcs['image'] }}" alt="{{ $attachment->title }}" class="img-rounded img-responsive">
        </a>
    @elseif($attachment->type === 'album')
        @foreach($attachment->childs()->limit(5)->get() as $key => $photo)
            <a href="?show=modal&type={{$photo->type}}&id={{$photo->id}}&album={{$attachment->id}}&post={{$post->id}}" onclick="return showAttachment(this);" rel="nofollow" data-attachment-type="photo" data-attachment-id="{{$photo->id}}" data-attachment-parent-type="album" data-attachment-parent-id="{{$attachment->id}}" class="post-attachment-album-control n{{$key}}">
                <img src="{{$photo->srcs['src']}}" class="post-attachment-album-photo">
            </a>
        @endforeach
    @elseif($attachment->type === 'audio')
        <div class="player">
            <div class="player-actions">
                <a href="#" onclick="return play(this, '{{
                    route('audio_get', [
                        'id' => $attachment->id
                    ], false)
                }}');" rel="nofollow" class="btn btn-link btn-xs player-btn-play"><span class="glyphicon glyphicon glyphicon-play"></span></a>
                <a href="#" rel="nofollow" class="btn btn-link btn-xs player-btn-pause" style="display: none;"><span class="glyphicon glyphicon glyphicon-pause"></span></a>
            </div>
            <div class="player-title"><strong>{{$attachment->title}}</strong> – {{$attachment->description}}</div>
            <div class="player-duration">3:55</div>
            <div class="player-controls" style="display: none;">
                <div class="player-progress-wrapper">
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" style="width: 35%"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>