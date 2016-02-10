@extends('app')

@section('content')
    <div id="fullpage">
        {!! Shortcode::compile($page_content) !!}
    </div>
@endsection