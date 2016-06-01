@extends('app')

@section('content')
    <br>
    @if($post->text)
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 post-one">
                <div class="post-one-text">{!! text_linked($post->text) !!}</div>
            </div>
        </div>
    </div>
    <br>
    @endif
    @if(sizeof($photos) > 0)
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div id="post-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($photos as $key => $photo)
                            <div class="item @if($key === 0) active @endif">
                                <img src="{{ $photo->srcs['image_big'] }}" height="100%" class="img-responsive">
                            </div>
                        @endforeach
                    </div>

                    @if(sizeof($photos) > 1)
                        <a class="left carousel-control" href="#post-carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Предыдущий</span>
                        </a>

                        <a class="right carousel-control" href="#post-carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Следующий</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    @endif
    @if(sizeof($polls) > 0)
    <div class="container">
        <div class="row">
            @foreach($polls as $poll)
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="alert alert-info">{!! $poll->title !!}</div>
                </div>
            @endforeach
        </div>
    </div>
    <br>
    @endif
    @if(sizeof($videos) > 0)
    <div class="container">
        <div class="row video-player">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="row">
                    @foreach($videos as $key => $video)
                        <div class="col-sm-4">
                            <div class="video-player-playlist-item">
                                <a href="{{ route('load_video', ['vid' => $video->id]) }}" class="video-player-playlist-item-link">
                                    <img src="{{ $video->srcs['image_small'] }}" class="video-player-playlist-item-thumbnail">
                                    <i class="video-player-icon-play glyphicon glyphicon-play-circle"></i>
                                    <i class="video-player-icon-spinner glyphicon glyphicon-refresh"></i>
                                </a>
                                <p>{{ $video->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>
    @endif
    @if(sizeof($audios) > 0)
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <ul class="audio-player list-unstyled">
                    @foreach($audios as $audio)
                        <li class="audio-player-item" data-url="{{ route('load_audio', ['aid' => $audio->id]) }}">
                            <div class="audio-player-actions">
                                <div class="audio-player-action-play">
                                    <a href="#" class="audio-player-action-play-control"><i class="glyphicon glyphicon-play"></i></a>
                                </div>
                                <div class="audio-player-action-pause">
                                    <a href="#" class="audio-player-action-pause-control"><i class="glyphicon glyphicon-pause"></i></a>
                                </div>
                                <div class="audio-player-action-load">
                                    <div class="audio-player-action-load-control"><i class="glyphicon glyphicon-refresh"></i></div>
                                </div>
                            </div>
                            <div class="audio-player-info">
                                <div class="audio-player-info-time">
                                    <div class="audio-player-info-time-duration">{{ floor($audio->srcs['duration'] / 60) }}:{{ sprintf('%02d', $audio->srcs['duration'] % 60) }}</div>
                                </div>
                                <div class="audio-player-info-name"><strong>{{ $audio->title }}</strong> – {{ $audio->description }}</div>
                                <div class="audio-player-info-bar">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <br>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <p class="small">{{ $post->date->formatLocalized('%A %d %B %Y в %H:%M') }}, <a href="https://vk.com/wall{{ $post->external_id }}" target="_blank">источник</a></p>
            </div>
        </div>
    </div>
    @if($nextPostUrl || $prevPostUrl)
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                @if($prevPostUrl)
                    <div class="pull-left"><a href="{{ $prevPostUrl }}">Предыдущая запись</a></div>
                @endif
                @if($nextPostUrl)
                    <div class="pull-right"><a href="{{ $nextPostUrl }}">Следующая запись</a></div>
                @endif
            </div>
        </div>
    </div>
    @endif
    <br>
    <br>
@endsection