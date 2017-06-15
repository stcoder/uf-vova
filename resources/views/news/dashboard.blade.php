@extends('app')

@section('title')
Новости - 
@endsection

@section('meta-soc')
<meta property="og:title" content="Новости - Универсальные бойцы Екатеринбург" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="Новости - Универсальные бойцы Екатеринбург" />
<meta property="og:url" content="article" />
<meta property="og:description" content="Новости - спортивного клуба Универсальные бойцы в г. Екатеринбург" />
<meta property="og:image" content="{{ asset('images/logo-big.png') }}" />

<meta name="twitter:title" content="Новости - Универсальные бойцы Екатеринбург" />
<meta name="twitter:description" content="Новости - спортивного клуба Универсальные бойцы в г. Екатеринбург" />
<meta name="twitter:image" content="{{ asset('images/logo-big.png') }}" />
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="section-header">
        <h2 class="section-header-title text-center">Новости</h2>
        <h3 class="section-header-title-sub text-center">наши последние записи</h3>
        <div class="section-header-divider">
          <span class="section-header-divider-left"></span>
          <i class="section-header-divider-icon glyphicon glyphicon-star"></i>
          <span class="section-header-divider-right"></span>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="news-list">
        @foreach($news_list as $news)
        <div class="news">
          <h2 class="news-title">
            <a href="{{ route('news', ['date' => $news->published_at->formatLocalized('%Y-%m-%d'), 'slug' => $news->slug]) }}" class="news-link-more">{{ $news->title }}</a>
            </h2>
          <span class="news-date">Опубликовано {{ $news->published_at->formatLocalized('%d %B %Y в %H:%M') }}</span>
          @if($news->header_image)
          <img src="{{ $news->header_image->thumbnail('preview-by-news') }}" alt="{{ $news->title }}" class="news-image img-responsive">
          @endif
          <p class="news-short-text">{{ $news->short_content }}</p>
          <a href="{{ route('news', ['date' => $news->published_at->formatLocalized('%Y-%m-%d'), 'slug' => $news->slug]) }}" class="news-link-more">Подробней</a>
        </div>
        @endforeach
        {!! $news_list->render() !!}
      </div>
    </div>
  </div>
</div>
@endsection