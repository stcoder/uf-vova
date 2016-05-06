<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="media-left pull-left">
                        <img src="{{ $group['photo'] }}" alt="{{ $group['name'] }}" class="media-object">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $group['name'] }}</h4>
                        <div class="small">подключен {{ $group['integrated-date']->formatLocalized('%d %B %Yг.') }}</div>
                        @if (isset($group['updated-date']))
                            <div class="small">обновлен {{ $group['updated-date']->formatLocalized('%d %B %Yг. в %H:%I') }}</div>
                        @endif
                        <hr>
                        <a class="btn btn-primary btn-xs" href="{{ route('admin.integration.imports.posts.import') }}" role="button">Импортировать</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            @forelse($posts as $key=>$post)
                <div class="col-md-4">
                    <div class="thumbnail">
                        @foreach($post->attachments()->limit(1)->get() as $attachment)
                            @if($attachment->type === 'video')
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $attachment->srcs['player'] }}"></iframe>
                                </div>
                            @elseif($attachment->type === 'album')
                                @foreach($attachment->childs()->limit(1)->get() as $photo)
                                    <img src="{{ $photo->srcs['src_big'] }}">
                                @endforeach
                            @elseif($attachment->type === 'photo')
                                <img src="{{ $attachment->srcs['src_big'] }}">
                            @endif
                        @endforeach
                        <div class="caption">
                            <p>{!! $post->text !!}</p>
                            @foreach($post->attachments()->offset(1)->limit(1)->get() as $attachmentIn)
                                @if($attachmentIn->type === 'audio')
                                    <strong>{{$attachmentIn->title}} – {{$attachmentIn->description}}</strong>
                                    <audio controls="" name="media">
                                        <source src="{{$attachmentIn->srcs['url']}}" type="audio/mpeg">
                                    </audio>
                                @endif
                            @endforeach
                            <p class="small">{{ $post->date }}</p>
                            <p><a href="#" class="btn btn-primary btn-xs" role="button">Открыть</a> <a href="#" class="btn btn-default btn-xs" role="button">Удалить</a></p>
                        </div>
                    </div>
                </div>
                @if (++$key % 3 === 0)
                    <div class="clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block"></div>
                @endif
            @empty
                <div class="col-md-12">
                    <div class="alert alert-info">Записей нет. Нажмите кнопку "импортировать" для загрузку записей.</div>
                </div>
            @endforelse
            <div class="col-md-12">
                {!! $posts->render() !!}
            </div>
        </div>
    </div>
</div>