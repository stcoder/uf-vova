<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @if($before)
            @foreach($before as $item)
                <div class="item">
                    @if($item['type'] === 'photo')
                        <img src="{{$item['src']}}" class="img-responsive">
                    @elseif($item['type'] === 'video')
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{$item['player']}}"></iframe>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
        <div class="item active">
            @if($attachment['type'] === 'photo')
                <img src="{{$attachment['src']}}" class="img-responsive">
            @elseif($attachment['type'] === 'video')
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{$attachment['player']}}"></iframe>
                </div>
            @endif
        </div>
        @if($after)
            @foreach($after as $item)
                <div class="item">
                    @if($item['type'] === 'photo')
                        <img src="{{$item['src']}}" class="img-responsive">
                    @elseif($item['type'] === 'video')
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{$item['player']}}"></iframe>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    @if(sizeof($before) > 0 || sizeof($after) > 0)
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    @endif
</div>