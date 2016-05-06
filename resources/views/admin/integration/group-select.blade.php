<div class="row">
    @foreach($groups as $group)
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="media-left pull-left">
                        <img class="media-object" src="{{ $group['photo'] }}" alt="{{ $group['name'] }}">
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">{{ $group['name'] }}</h5>
                        <div class="small"><a href="{{ route('admin.integration.group-set', ['group_id' => $group['gid']]) }}">подключить</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix visible-md-block"></div>
    @endforeach
</div>