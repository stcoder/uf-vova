<td>
    <span class="label label-{{ $class }}">{{ $label }}</span>&nbsp;
    @if($publishedable)
        <small>{{ date('d.m.y в H:i', strtotime($published_at)) }}&nbsp;<a href="{{ $url }}" data-toggle="tooltip" title="Открыть" target="_blank"><i class="fa fa-globe"></i></a></small>
    @endif
</td>