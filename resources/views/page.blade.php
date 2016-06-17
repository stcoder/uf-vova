@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="history">
                    <div class="section-header">
                        <h2 class="section-header-title text-center">{{ $page_title }}</h2>
                        <div class="section-header-divider">
                            <span class="section-header-divider-left"></span>
                            <i class="section-header-divider-icon glyphicon glyphicon-star"></i>
                            <span class="section-header-divider-right"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 post-one">
                <div class="post-one-text">{!! Shortcode::compile($page_content) !!}</div>
            </div>
        </div>
    </div>
    <p>&nbsp;</p>
@endsection