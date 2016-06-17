@extends('app')

@section('content')
{{-- Start about clube --}}
<div id="about" data-section="about" style="background-image: url('http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/concrete_seamless.png'); background-attachment: fixed;">
    <div class="container-fluid">
        {{-- Start section header --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="history">
                    <div class="section-header">
                        <h2 class="section-header-title text-center">О клубе</h2>
                        <h3 class="section-header-title-sub text-center">история развития</h3>
                        <div class="section-header-divider">
                            <span class="section-header-divider-left"></span>
                            <i class="section-header-divider-icon glyphicon glyphicon-star"></i>
                            <span class="section-header-divider-right"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End section header --}}

        {{-- Start history items --}}
        <div class="row">
            <div class="history-wrapper">
                <div class="history-container">

                    {{-- Start history item --}}
                    @foreach($histories as $history)
                    <div class="history-item">
                        <div class="history-caption-container">
                            <div class="history-caption __to-animate">
                                <h3 class="history-caption-date">{{ $history->title }}</h3>
                                @if($history->description)
                                <div class="history-caption-message">{{ $history->description }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="history-body-container">
                            @foreach($history->events()->orderBy('date_event', 'ASC')->get() as $event)
                            <div class="history-line"></div>
                            <div class="history-badge">
                                <div class="__to-animate anim-delay-0-3 history-badge-circle"></div>
                                <i class="__to-animate anim-delay-0-3 glyphicon glyphicon-arrow-right history-badge-icon"></i>
                            </div>
                            <div class="history-body">
                                <h3 class="history-body-title __to-animate">{{ $event->title }}</h3>
                                @if($event->image)
                                <img src="{{ $event->image }}" width="100%" class="img-responsive" alt="{{ $event->title }}">
                                <br>
                                @endif
                                <div class="history-body-content __to-animate">{!! $event->description !!}</div>
                                <div class="history-body-time __to-animate"><small>{{ \Carbon\Carbon::instance(new DateTime($event->date_event))->formatLocalized('%d.%m.%Y') }}</small></div>
                            </div>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    {{-- End history item --}}

                </div>
            </div>
        </div>
        {{-- End history items --}}
    </div>
</div>
{{-- End about clube --}}
@endsection