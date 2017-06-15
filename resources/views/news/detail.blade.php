@extends('app')

@section('title')
{{ $news->title }} - 
@endsection

@section('meta-soc')
<meta property="og:title" content="{{ $news->title }} - Универсальные бойцы Екатеринбург" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="{{ $news->title }} - Универсальные бойцы Екатеринбург" />
<meta property="og:url" content="article" />
<meta property="og:description" content="{{ $news->short_content }}" />
@if($news->header_image)
<meta property="og:image" content="{{ $news->header_image->thumbnail('preview-by-news') }}" />
<meta name="twitter:image" content="{{ $news->header_image->thumbnail('preview-by-news') }}" />
@endif

<meta name="twitter:title" content="{{ $news->title }} - Универсальные бойцы Екатеринбург" />
<meta name="twitter:description" content="{{ $news->short_content }}" />
@endsection

@section('content')
@if($news->header_image)
<div id="slider">
  <div class="owl-carousel owl-carousel-fullwidth">
    {{-- Start slide --}}
    <div class="item" style="background-image: url({{ $news->header_image->thumbnail('big_slide') }})">
      <div class="overlay"></div>
      <div class="container" style="position: relative;">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="slide-wrapper">
              <div class="slide-content">
                <h1 class="slide-lead __to-animate">{{ $news->title }}</h1>
                @if($news->short_content)
                <h2 class="slide-sub-lead __to-animate anim-delay-1-3">{{ $news->short_content }}</h2>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End slide --}}
  </div>
</div>
<br>
@else
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="history">
                <div class="section-header">
                    <h2 class="section-header-title text-center">{{ $news->title }}</h2>
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
@endif
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2"">
              <div class="news">
                <div class="news-text">{!! Shortcode::compile($news->content) !!}</div>
                <span class="news-date news-date--with-detail">Опубликовано {{ $news->published_at->formatLocalized('%d %B %Y в %H:%M') }}</span>
              </div>
            </div>
        </div>
    </div>
@endsection