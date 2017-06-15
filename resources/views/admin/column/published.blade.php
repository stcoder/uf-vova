<td>
    <span class="label label-{{ $class }}">{{ $label }}</span>
    @if($publishedable)
        <br>
        <small>{{ $published_at }}&nbsp;<a href="{{ $url }}" data-toggle="tooltip" title="Открыть" target="_blank"><i class="fa fa-globe"></i></a></small>
    @endif
</td>