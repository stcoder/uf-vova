<div class="slide slide-{{ $slide->id }}" style="background: url({{ $slide->image->thumbnail('big_slide') }})">
    <h2>{{ $slide->title }}</h2>
    @if($slide->description)
        <p class="lead">{{ $slide->description }}</p>
    @endif
    <p class="lead">
        {!! link_to_route('page', 'Подробней', ['page' => $slide->page->slug], ['class' => 'btn btn-primary']) !!}
    </p>
</div>
