@extends('app')

@section('meta-soc')
<meta property="og:title" content="Универсальные бойцы Екатеринбург" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="Универсальные бойцы Екатеринбург" />
<meta property="og:url" content="article" />
<meta property="og:description" content="Спортивный клуб Универсальные бойцы в г. Екатеринбург" />
<meta property="og:image" content="{{ asset('images/logo-big.png') }}" />

<meta name="twitter:title" content="Универсальные бойцы Екатеринбург" />
<meta name="twitter:description" content="Спортивный клуб Универсальные бойцы в г. Екатеринбург" />
<meta name="twitter:image" content="{{ asset('images/logo-big.png') }}" />
@endsection

@section('content')
{{-- Start slider --}}
<div id="slider" data-section="slider">
  <div class="owl-carousel owl-carousel-fullwidth">
    @foreach($slides as $slide)
    {{-- Start slide --}}
    <div class="item" style="background-image: url({{ $slide->image->thumbnail('big_slide') }})">
      <div class="overlay"></div>
      <div class="container" style="position: relative;">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="slide-wrapper">
              <div class="slide-content">
                <h1 class="slide-lead __to-animate">{{ $slide->title }}</h1>
                <h2 class="slide-sub-lead __to-animate anim-delay-1-3">{{ $slide->description }}</h2>
                <p class="__to-animate anim-delay-1-6">
                  {!! link_to_route('page', 'Читать подробней', ['page' => $slide->page->slug], ['class' => 'btn btn-primary']) !!}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End slide --}}
    @endforeach
  </div>
</div>
{{-- End slider --}}

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
                  @if($event->more)
                    <a href="{{ route('about') }}" type="button" class="btn btn-primary">
                      Подробней
                    </a>
                    @set('stop', true)
                    @break
                  @endif
                @endforeach
              </div>
            </div>
            @if(isset($stop) && $stop === true)
              @break
            @endif
          @endforeach
          {{-- End history item --}}

        </div>
      </div>
    </div>
    {{-- End history items --}}
  </div>
</div>
{{-- End about clube --}}

{{-- Start price --}}
<div id="price" data-section="price">
  <div class="container">
    {{-- Start price header --}}
    <div class="row">
      <div class="col-sm-12">
        <div class="history">
          <div class="section-header">
            <h2 class="section-header-title text-center">Расписание и стоимость</h2>
            <h3 class="section-header-title-sub text-center">первая тренировка <strong>бесплатно!</strong></h3>
            <div class="section-header-divider">
              <span class="section-header-divider-left"></span>
              <i class="section-header-divider-icon glyphicon glyphicon-star"></i>
              <span class="section-header-divider-right"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End price header --}}

    <div class="row price-wrappers">
    @foreach($schedule_and_cost as $item)
      {{-- Start items --}}
      <div class="col-sm-12">
        <div class="price">
          <div class="price-header">{{ $item->title }}</div>
          <div class="price-content">
            <div class="price-body">{!! $item->text !!}</div>
          </div>
        </div>
      </div>
      {{-- End items --}}
      @endforeach
    </div>
  </div>
</div>
{{-- End price --}}

@if($review)
{{-- Start reviews --}}
<div id="reviews" data-section="reviews" class="reviews">
  <div class="container">
    {{-- Start post header --}}
    <div class="row">
      <div class="col-sm-12">
        <div class="history">
          <div class="section-header">
            <h2 class="section-header-title text-center">Отзывы</h2>
            <h3 class="section-header-title-sub text-center">мысли наших бойцов о тренировках</h3>
            <div class="section-header-divider">
              <span class="section-header-divider-left"></span>
              <i class="section-header-divider-icon glyphicon glyphicon-star"></i>
              <span class="section-header-divider-right"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End post header --}}

    {{-- Start items --}}
    <div class="row review">
      <div class="col-sm-3 col-sm-offset-1 text-center review-profile">
        <img src="{{ $review->profile->photo }}" class="review-profile-image">
        <p><a target="_blank" href="http://vk.com/{{ $review->profile->domain }}" class="review-profile-link">{{ $review->profile->first_name }} {{ $review->profile->last_name }}</a></p>
      </div>
      <div class="col-sm-6 review-text">
        <div class="review-text-small">{!! str_limit($review->text, 400) !!}</div>
        @if(strlen($review->text) > 400)
          <div class="review-text-link"><a href="#">Прочитать полностью</a></div>
          <div class="review-text-full">{!! $review->text !!}</div>
        @endif
        <div class="action-next-loader loader-review">
          <button type="button" id="load_next_reviews" data-url="{{route('load_review')}}" data-loading-text="Загружаю..." class="btn btn-primary" autocomplete="off">
            Еще отзыв
          </button>
        </div>
      </div>
    </div>
    {{-- End items --}}
  </div>
</div>
{{-- End reviews --}}
@endif

{{-- Start contacts --}}
<div id="contacts" data-section="contacts" class="contacts" style="background-image: url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/cork-wallet.png); background-attachment: fixed;">
  <div class="container">
    {{-- Start contact header --}}
    <div class="row">
      <div class="col-sm-12">
        <div class="history">
          <div class="section-header">
            <h2 class="section-header-title text-center">Контакты</h2>
            <h3 class="section-header-title-sub text-center">наше местоположение и способы связи</h3>
            <div class="section-header-divider">
              <span class="section-header-divider-left"></span>
              <i class="section-header-divider-icon glyphicon glyphicon-star"></i>
              <span class="section-header-divider-right"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End contact header --}}

    <div class="row">
      <div class="col-sm-4">        
        <div class="contact-card">
          <div class="contact-card-image">
            <img src="https://pp.vk.me/c633220/v633220404/73d3/qC6hp51J-74.jpg" class="img-circle" alt="Владимир Медведев">
          </div>
          <div class="contact-card-title">Владимир Медведев</div>
          <div class="contact-card-info">
            <p>+7 (982) 639-75-18</p>
            <p><a href="https://vk.com/write224476404" target="_blank">Написать в VK</a></p>
          </div>
        </div>
      </div>
      <div class="col-sm-7 col-sm-offset-1">
        <p><i class="glyphicon glyphicon-map-marker"></i> ул. Красноармейская, 27 / СОК "Факел", 2 этаж.</p>
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=c6Wh4eG8IcQ9zUNOElkabK1xgSbrlF5a&width=100%&height=250&lang=ru_RU&sourceType=constructor&scroll=false"></script>
      </div>
      <div class="col-sm-12">
        <div class="contact-socials-header">Мы в социальных сетях</div>
        <ul class="contact-socials list-unstyled">
          <li><a target="_blank" href="https://vk.com/universalfightersekb"><i class="fa fa-vk"></i></a></li>
          <li><a target="_blank" href="https://www.facebook.com/%D0%A3%D0%BD%D0%B8%D0%B2%D0%B5%D1%80%D1%81%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B5-%D0%B1%D0%BE%D0%B9%D1%86%D1%8B-%D0%95%D0%BA%D0%B0%D1%82%D0%B5%D1%80%D0%B8%D0%BD%D0%B1%D1%83%D1%80%D0%B3-1501676683493080/"><i class="fa fa-facebook"></i></a></li>
          <li><a target="_blank" href="https://www.instagram.com/universal_fighters_ekb/"><i class="fa fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
{{-- End contacts --}}
@endsection