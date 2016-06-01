@extends('app')

@section('content')
{{-- Start slider --}}
<div id="slider" data-section="slider">
  <div class="owl-carousel owl-carousel-fullwidth">
    {{-- Start slide --}}
    <div class="item" style="background-image: url(//img11.nnm.ru/4/3/3/7/9/2ca11af4c6716b84fab2cca8ea4.jpg)">
      <div class="overlay"></div>
      <div class="container" style="position: relative;">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="slide-wrapper">
              <div class="slide-content">
                <h1 class="slide-lead __to-animate">Вин Чун</h1>
                <h2 class="slide-sub-lead __to-animate anim-delay-1-3">максимум эффективности при минимуме движений</h2>
                <p class="__to-animate anim-delay-1-6">
                  <a href="http://freehtml5.co/" target="_blank" class="btn btn-primary">Читать подробней</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End slide --}}

    {{-- Start slide --}}
    <div class="item" style="background-image: url(//img01.quesabesde.com/media/img/noti/0058/victor_fraile.jpg)">
      <div class="overlay"></div>
      <div class="container" style="position: relative;">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="slide-wrapper">
              <div class="slide-content">
                <h1 class="slide-lead __to-animate">Ушу-саньда</h1>
                <h2 class="slide-sub-lead __to-animate anim-delay-1-3">спортивно-соревновательные поединки, проводимые в полный контакт, с добавлением бросковой техники</h2>
                <p class="__to-animate anim-delay-1-6">
                  <a href="http://freehtml5.co/" target="_blank" class="btn btn-primary">Читать подробней</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End slide --}}

    {{-- Start slide --}}
    <div class="item" style="background-image: url(//bjj59.ru/images/fon.jpg)">
      <div class="overlay"></div>
      <div class="container" style="position: relative;">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="slide-wrapper">
              <div class="slide-content">
                <h1 class="slide-lead __to-animate">Джиу джитсу</h1>
                <h2 class="slide-sub-lead __to-animate anim-delay-1-3">японская вольная борьба и особая система приёмов самозащиты без оружия</h2>
                <p class="__to-animate anim-delay-1-6">
                  <a href="http://freehtml5.co/" target="_blank" class="btn btn-primary">Читать подробней</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End slide --}}
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
          <div class="history-item">
            <div class="history-caption-container">
              <div class="history-caption __to-animate">
                <h3 class="history-caption-date">2008 <small>год</small></h3>
                <div class="history-caption-message">С чего все началось</div>
              </div>
            </div>
            <div class="history-body-container">
              <div class="history-line"></div>
              <div class="history-badge">
                <div class="__to-animate anim-delay-0-3 history-badge-circle"></div>
                <i class="__to-animate anim-delay-0-3 glyphicon glyphicon-arrow-right history-badge-icon"></i>
              </div>
              <div class="history-body">
                <h3 class="history-body-title __to-animate anim-delay-0-3">Становление клуба</h3>
                <div class="history-body-content __to-animate anim-delay-0-3">
                  <p>Президент федерации Вин Чун Урала М. Бурдин возложил на плечи нынешнего тренера Владимира Медведева обязаности главного инструктора федерации.</p>
                </div>
              </div>
            </div>
          </div>
          {{-- End history item --}}

          {{-- Start history item --}}
          <div class="history-item">
            <div class="history-caption-container">
              <div class="history-caption __to-animate">
                <h3 class="history-caption-date">2008 <small>год</small></h3>
                <div class="history-caption-message">Семинар</div>
              </div>
            </div>
            <div class="history-body-container">
              <div class="history-line"></div>
              <div class="history-badge">
                <div class="__to-animate anim-delay-0-3 history-badge-circle"></div>
                <i class="__to-animate anim-delay-0-3 glyphicon glyphicon-arrow-right history-badge-icon"></i>
              </div>
              <div class="history-body">
                <h3 class="history-body-title __to-animate anim-delay-0-3">Семинар Анатолия Белощина</h3>
                <div class="history-body-content __to-animate anim-delay-0-3">
                  <p>Был проведен третий семинар Анатолия Белощина Президента DMWCI, на котором была проведена успешная аттестация наших воспитаников на 1 уровень техники Siu Lim Tao.</p>
                </div>
              </div>
            </div>
          </div>
          {{-- End history item --}}

          {{-- Start history item --}}
          <div class="history-item">
            <div class="history-caption-container">
              <div class="history-caption __to-animate">
                <h3 class="history-caption-date">2008 <small>год</small></h3>
                <div class="history-caption-message">Расширяемся</div>
              </div>
            </div>
            <div class="history-body-container">
              <div class="history-line"></div>
              <div class="history-badge">
                <div class="__to-animate anim-delay-0-3 history-badge-circle"></div>
                <i class="__to-animate anim-delay-0-3 glyphicon glyphicon-arrow-right history-badge-icon"></i>
              </div>
              <div class="history-body">
                <h3 class="history-body-title __to-animate anim-delay-0-3">Выход из состава</h3>
                <div class="history-body-content __to-animate anim-delay-0-3">
                  <p>Клуб вышел из состава Федерации Вин Чун Урала и присоединился к Международной Организации Вин Чун (International Wing Chun Organization).</p>
                </div>
              </div>
            </div>
          </div>
          {{-- End history item --}}

          {{-- Start history item --}}
          <div class="history-item">
            <div class="history-caption-container">
              <div class="history-caption __to-animate">
                <h3 class="history-caption-date">2008 <small>год</small></h3>
                <div class="history-caption-message">С чего все началось</div>
              </div>
            </div>
            <div class="history-body-container">
              <div class="history-line"></div>
              <div class="history-badge">
                <div class="__to-animate anim-delay-0-3 history-badge-circle"></div>
                <i class="__to-animate anim-delay-0-3 glyphicon glyphicon-arrow-right history-badge-icon"></i>
              </div>
              <div class="history-body">
                <h3 class="history-body-title __to-animate anim-delay-0-3">Становление клуба</h3>
                <div class="history-body-content __to-animate anim-delay-0-3">
                  <p>Президент федерации Вин Чун Урала М. Бурдин возложил на плечи нынешнего тренера Владимира Медведева обязаности главного инструктора федерации.</p>
                </div>
              </div>
            </div>
          </div>
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

    {{-- Start items --}}
    <div class="row price-wrappers">
      <div class="col-sm-4">
        <div class="price">
          <div class="price-header">Разовое занятие</div>
          <div class="price-content">
            <div class="price-cost">
              400&nbsp;<small>руб.</small>
              <div class="price-cost-desc">для мужчин и женщин</div>
            </div>
            <div class="price-separator"></div>
            <div class="price-body">
              <p>Длительность тренировки: 2 часа</p>
              <p>Возраст: от 18 лет</p>
              <p>Занятия проходят каждый <strong>вторник</strong>, <strong>пятницу</strong> и <strong>воскрсенье</strong> в <u>20:00</u>.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="price">
          <div class="price-header">Старшая группа</div>
          <div class="price-content">
            <div class="price-body">
              <p class="price-body-title">Четыре занятия:</p>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="price-cost">
                      1600&nbsp;<small>руб.</small>
                      <div class="price-cost-desc">для мужчин</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="price-cost">
                      1400&nbsp;<small>руб.</small>
                      <div class="price-cost-desc">для женщин</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="price-separator"></div>
              <div class="price-body-title">Восемь занятий:</div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="price-cost">
                      1900&nbsp;<small>руб.</small>
                      <div class="price-cost-desc">для мужчин</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="price-cost">
                      1600&nbsp;<small>руб.</small>
                      <div class="price-cost-desc">для женщин</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="price-separator"></div>
              <div class="price-body-title">Двенадцать занятий:</div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="price-cost">
                      2400&nbsp;<small>руб.</small>
                      <div class="price-cost-desc">для мужчин</div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="price-cost">
                      2100&nbsp;<small>руб.</small>
                      <div class="price-cost-desc">для женщин</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="price-separator"></div>
              <p>Длительность тренировки: 2 часа</p>
              <p>Возраст: от 18 лет</p>
              <p>Занятия проходят каждый <strong>вторник</strong>, <strong>пятницу</strong> и <strong>воскрсенье</strong> в <u>20:00</u>.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="price">
          <div class="price-header">Детская группа</div>
          <div class="price-content">
            <div class="price-cost">
              1800&nbsp;<small>руб.</small>
              <div class="price-cost-desc">абонемент на 12 занятий</div>
            </div>
            <div class="price-separator"></div>
            <div class="price-body">
              <p>Длительность тренировки: 1 час 30 минут</p>
              <p>Возраст: от 7 до 13 лет</p>
              <p>Занятия проходят каждый <strong>вторник</strong>, <strong>пятницу</strong> и <strong>воскрсенье</strong> в <u>18:30</u>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End items --}}
  </div>
</div>
{{-- End price --}}

{{-- Start posts --}}
<div id="posts" data-section="posts" class="posts" style="background-color: #44465B; background-image: url('http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/ravenna.png'); background-attachment: fixed;">
  <div class="container">
    {{-- Start post header --}}
    <div class="row">
      <div class="col-sm-12">
        <div class="history">
          <div class="section-header">
            <h2 class="section-header-title text-center">Лента событий</h2>
            <h3 class="section-header-title-sub text-center">наши последние записи</h3>
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
    <div class="row">
      <div class="posts-container">
        @foreach($posts as $key => $post)
          <div class="col-lg-3 col-md-4 col-sm-6">
            @include('post.item', ['post' => $post])
          </div>
        @endforeach
      </div>
      @if($next_posts)
      <div class="col-sm-12">
        <div class="action-next-loader loader-posts">
          <button type="button" id="load_next_posts" data-url="{{$next_posts}}" data-loading-text="Загружаю..." class="btn btn-primary" autocomplete="off">
            Показать еще
          </button>
        </div>
      </div>
      @endif
    </div>
    {{-- End items --}}
  </div>
</div>
{{-- End posts --}}

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