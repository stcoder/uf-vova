var $modal = $("#modal");
var $navbar = $('#navbar > ul');
var $posts = $('#posts');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$modal.on('hidden.bs.modal', function() {
  $modal.find('.modal-body').html('');
});

/** Start Carousel Feature Slide **/
var owlCrouselFeatureSlide = function() {

  var owl = $('.owl-carousel');

  owl.on('initialized.owl.carousel change.owl.carousel',function(elem){
    var current = elem.item.index;
    $(elem.target).find('.owl-item').eq(current).find('.__to-animate').removeClass('fadeInUp animated');
  });
  owl.on('initialized.owl.carousel changed.owl.carousel',function(elem){
    setTimeout(function(){
      var current = elem.item.index;
      $(elem.target).find(".owl-item").eq(current).find(".__to-animate").addClass('fadeInUp animated');
    }, 700);
  });
  owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 0,
    responsiveClass: true,
    nav: true,
    dots: true,
    autoHeight: true,
    smartSpeed: 600,
    autoplay: true,
    autoplayTimeout: 10000,
    autoplayHoverPause: true,
    navText: [
      "<i class='glyphicon glyphicon-chevron-left owl-direction'></i>",
      "<i class='glyphicon glyphicon-chevron-right owl-direction'></i>"
    ]
  });

};
/** End Carousel Feature Slide **/

/** Start navigation **/
var clickMenu = function() {
  $('a.nav-control').click(function(event) {
    var section = $(this).data('nav-section') || 'slider';

    scrollTo(section);

    if ($navbar.is(':visible')) {
      $navbar.removeClass('in');
      $navbar.attr('aria-expanded', 'false');
    }

    event.preventDefault();
    return false;
  });
};

var scrollTo = function(section) {
  $('html, body').animate({
    scrollTop: $('[data-section="'+section+'"]').offset().top
  }, 500);
};

var navActive = function(section) {
  $navbar.find('li').removeClass('active');
  $navbar.each(function() {
    $(this).find('a[data-nav-section="'+section+'"]').closest('li').addClass('active');
  });
};

var navigationSection = function() {
  var $section = $('div[data-section]');

  $section.waypoint(function(direction) {
    if (direction === 'down') {
      navActive($(this.element).data('section'));
    }
  }, {
    offset: '150px'
  });

  $section.waypoint(function(direction) {
    if (direction === 'up') {
      navActive($(this.element).data('section'));
    }
  }, {
    offset: function() {
      return -$(this.element).height() + 135;
    }
  });
};
/** End navigation **/

/** Start scroll **/
var windowScroll = function() {
  var lastScrollTop = 0;

  $(window).scroll(function(event) {
    var scrlTop = $(this).scrollTop();
    var $navContainer = $('.navbar-container');

    if (scrlTop > 500 && scrlTop <= 2000) {
      if (!$navContainer.hasClass('navbar-fixed-top')) {
        $navContainer.addClass('navbar-fixed-top slideInDown animated');
      }
    } else if (scrlTop <= 500) {
      if ($navContainer.hasClass('navbar-fixed-top')) {
        $navContainer.removeClass('slideInDown animated').addClass('slideOutUp animated');
        setTimeout(function() {
          $navContainer.removeClass('navbar-fixed-top slideOutUp animated');
        }, 200);
      }
    }
  });
};
/** End scroll **/

// === Running
owlCrouselFeatureSlide();
windowScroll();
clickMenu();
navigationSection();

$('.history-item').waypoint({
  handler: function() {
    var $el = $(this.element);
    $el.find('.history-caption').addClass('animated fadeInLeft');
    $el.find('.history-badge-circle').addClass('animated bounceIn');
    $el.find('.history-badge-icon').addClass('animated rotateInDownLeft');
    $el.find('img').addClass('animated fadeIn').css({'animation-delay': '1.8s'});
    $el.find('.history-body-title').each(function(num) {
      var delay = (num + 1) * 1.4;
      $(this).addClass('animated fadeInDown').css({
        'animation-delay': delay + 's'
      });
    });
    $el.find('.history-body-content').each(function(num) {
      var delay = (num + 1) * 1.6;
      $(this).addClass('animated fadeInUp').css({
        'animation-delay': delay + 's'
      });
    });
    $el.find('.history-body-time').each(function(num) {
      var delay = (num + 1) * 1.8;
      $(this).addClass('animated fadeInLeft').css({
        'animation-delay': delay + 's'
      });
    });
  },
  offset: '80%'
});

/** Start player **/
var activeSong = null;
function play(el, id) {

  var $player = $(el).parents('.player');
  var $play = $(el);
  var $pause = $player.find('.player-btn-pause');

  $play.hide();
  $pause.show();

  $pause.click(function(e) {
    e.preventDefault();

    $pause.hide();
    $play.show();
  });

  return false;
}

window.play = play;
/** End player **/

/** Start load next items **/
function loadNextItems() {
  var $items = $('.action-next-loader.loader-posts');

  $items.find('button').on('click', function(e) {
    var $el = $(this);
    var $btn = $el.button('loading');
    var url = $el.data('url');
    var isLast = false;

    var xhr = $.get(url);
    xhr.success(function(res) {
      switch(res.type) {
        case 'posts':
            postsController(res);
        break;
      }

      url = res.next_url || null;

      if (!url) {
        isLast = true;
      }
    }).error(function() {
      console.log(arguments);
    }).always(function() {
      if (isLast) {
        $btn.off('click');
        $btn.remove();
        return;
      }
      $el.data('url', url);
      $btn.button('reset');
    });
  });
}

function postsController(res) {
  var $posts = $('#posts .posts-container');
  if (res.items) {
    $.each(res.items, function(col, item) {
      var $col = $('<div/>', {class: 'col-lg-3 col-md-4 col-sm-6'});
      $col.append(item);
      $posts.append($col);
    });
  }
}
loadNextItems();
/** End load next items **/

/** Start review **/
window.review = new Review();
function Review() {
  var $section = $('#reviews');
  var $text = $section.find('.review-text');
  var $textSmall = $text.find('.review-text-small');
  var $textFull = $text.find('.review-text-full');
  var $linkMore = $text.find('.review-text-link a');
  var $nextReview = $section.find('#load_next_reviews');
  var $profileImage = $section.find('.review-profile-image');
  var $profileLink = $section.find('.review-profile-link');

  if ($linkMore.length > 0) {
    $linkMore.on('click', function(e) {
      e.preventDefault();
      $text.addClass('review-text__show-full');
    }.bind(this));
  }

  $nextReview.on('click', function(e) {
    e.preventDefault();
    var $el = $(e.target);
    var $btn = $el.button('loading');
    var url = $el.data('url');

    var xhr = $.get(url);
    xhr.success(function(res) {
      if (res.no && res.no == true) {
        $btn.hide();
        return;
      }
      $textSmall.html(res.text_small);

      if (res.text_isBig) {
        $linkMore.show();
        $textFull.html(res.text_full);
      } else {
        $linkMore.hide();
      }
      $profileImage.prop('src', res.profile_photo);
      $profileLink.prop('href', 'http://vk.com/' + res.profile_domain);
      $profileLink.html(res.profile_name);
      scrollTo('reviews');
    }).error(function() {
      console.log(arguments);
    }).always(function() {
      $text.removeClass('review-text__show-full');
      $btn.button('reset');
    }.bind(this));
  });
}
/** End review **/

/** Start show video **/
var $videoLinks = $('.video-player-playlist-item-link');
$videoLinks.on('click', function(e) {
  e.preventDefault();
  var parent_class = 'video-player-playlist-item';
  var parent_class_active = parent_class + '-active';
  var $target = $(this);
  var $parent = $target.parent('.' + parent_class);
  var hasActive = $parent.data('active') || false;

  if (hasActive) {
    return;
  }

  $parent.addClass(parent_class_active);
  $parent.data('active', true);
  var url = $target.prop('href');

  var xhr = $.get(url);
  xhr.success(function(res) {
    $modal.find('.modal-title').html(res.title);
    var $iframe = $(['<div class="embed-responsive embed-responsive-16by9">',
        '<iframe class="embed-responsive-item" src="'+res.player+'"></iframe></div>'].join(''));
    $modal.find('.modal-body').append($iframe).append($('<p>'+res.description+'</p>'));
  }).error(function() {
    $modal.find('.modal-title').html('Ошибка');
    $modal.find('.modal-body').append($('<p/>').html('Во время загрузки видео возникли ошибки.'));
  }).always(function() {
    $modal.modal('show');
    $parent.data('active', false);
    $parent.removeClass(parent_class_active);
  });
});
/** End show video **/

/** Start audio player **/
function AudioPlayer($element) {
  this.$el = $element;
  this.$currentItem = null;
  this.$currentBar = null;
  this.$currentDuration = null;
  this.$items = null;
  this.audio = null;
  this.setIntId = null;
  this.state = 'wait';
  this.classes = {
    'item': 'audio-player-item',
    'state': {
      'loading': 'audio-player--loading',
      'playing': 'audio-player--playing',
      'paused': 'audio-player--paused'
    },
    'controls': {
      'play': 'audio-player-action-play-control',
      'pause': 'audio-player-action-pause-control'
    },
    'info': {
      'duration': 'audio-player-info-time-duration'
    }
  };

  this.init();
}

AudioPlayer.prototype.init = function() {
  this.$items = this.$el.find('.' + this.classes.item);
  this.$el.on('click', '.' + this.classes.controls.play, this.onPlay());
  this.$el.on('click', '.' + this.classes.controls.pause, this.onPause());
};
AudioPlayer.prototype.play = function() {
  var src = this.$currentItem.data('src');

  if (!src) {
    return;
  }

  this.$currentItem.addClass(this.classes.state.playing);
  if (this.state != 'pause')
    this.audio = new Audio(src);
  this.audio.play();
  this.state = 'play';
  if (!this.setIntId) this.setIntId = setInterval(this.startPlayProgress.bind(this), 1000);
};
AudioPlayer.prototype.pause = function() {
  if (!this.audio) {
    return;
  }

  this.audio.pause();
  this.state = 'pause';
  this.$currentItem
      .removeClass(this.classes.state.playing)
      .addClass(this.classes.state.paused);
  this.pausePlayProgress();
};
AudioPlayer.prototype.stop = function() {
  if (this.$currentItem) {
    this.$currentItem.removeClass(this.classes.state.playing);
    this.$currentItem.removeClass(this.classes.state.paused);
  }
  this.stopPlayProgress();
  this.$currentItem = null;
  this.$currentBar = null;
  this.$currentDuration = null;

  if (this.audio) {
    this.audio.pause();
  }
  this.audio = null;
  this.state = 'stop';
};
AudioPlayer.prototype.next = function() {
  var $next = this.$currentItem.next();

  if ($next.length > 0) {
    $next.find('.' + this.classes.controls.play).trigger('click');
    return;
  }

  this.stop();
};
AudioPlayer.prototype.prev = function() {};
AudioPlayer.prototype.loading = function(auto_play) {
  auto_play || (auto_play = false);
  var url = this.$currentItem.data('url');
  if (!url) {
    return null;
  }

  var xhr = $.get(url);
  xhr.success(function(res) {
    this.$currentItem.data('loaded', true);
    this.$currentItem.data('src', res.url);
    this.$currentItem.removeClass(this.classes.state.loading);
    if (auto_play) {
      this.play();
    }
  }.bind(this)).error(function(err) {
    this.$currentItem.data('loaded', false);
    this.$currentItem.data('src', null);
  }.bind(this));
};
AudioPlayer.prototype.hasLoaded = function() {
  return this.$currentItem.data('loaded') || false;
};
AudioPlayer.prototype.onPlay = function() {
  var self = this;
  return function(e) {
    e.preventDefault();
    if (self.$currentItem) {
      var $prevItem = self.$currentItem;
    }

    var $currentItem = $(this).parents('.' + self.classes.item);

    if ($prevItem && $prevItem.get(0) != $currentItem.get(0)) {
      self.stop();
    }
    self.$currentItem = $currentItem;

    self.$currentBar = self.$currentItem.find('.progress-bar');
    self.$currentDuration = self.$currentItem.find('.' + self.classes.info.duration);

    if (!self.hasLoaded()) {
      self.$currentItem.addClass(self.classes.state.loading);
      self.loading(true);
      return;
    }

    if (self.$currentItem.hasClass(self.classes.state.paused)) {
      self.$currentItem.removeClass(self.classes.state.paused);
    }
    self.play();
  };
};
AudioPlayer.prototype.onPause = function() {
  var self = this;
  return function(e) {
    e.preventDefault();
    self.pause();
  };
};
AudioPlayer.prototype.formatTime = function(t) {
  var res, sec, min, hour;
  t = Math.max(t, 0);
  sec = t % 60;
  res = (sec < 10) ? '0'+sec : sec;
  t = Math.floor(t / 60);
  min = t % 60;
  res = min+':'+res;
  t = Math.floor(t / 60);
  if (t > 0) {
    if (min < 10) res = '0' + res;
    res = t+':'+res;
  }
  return res;
};
AudioPlayer.prototype.startPlayProgress = function() {
  var duration = Math.round(this.audio.duration) || 0;
  var currTime = Math.round(this.audio.currentTime);
  var per = currTime / duration * 100;
  per = Math.min(100, Math.max(0, per));
  this.setTime(duration - currTime);
  this.$currentBar.css({width: per + '%'});

  if (this.audio.ended) {
    this.stopPlayProgress();
    this.next();
  }
};
AudioPlayer.prototype.stopPlayProgress = function() {
  if (!this.audio) {
    return;
  }
  var duration = Math.round(this.audio.duration) || 0;
  this.setTime(duration);
  this.$currentBar.css({width: 0});
  this.pausePlayProgress();
};
AudioPlayer.prototype.pausePlayProgress = function() {
  clearInterval(this.setIntId);
  this.setIntId = null;
};
AudioPlayer.prototype.setTime = function(len) {
  var t = this.formatTime(len);
  this.$currentDuration.html(t);
};

window.audio_player = new AudioPlayer($('.audio-player'));
/** End audio player **/

window.showFeedback = function() {
  // Открыли форму
  yaCounter38753525.reachGoal('FEEDBACK_OPEN');

  var $form = $('<form>', {'data-toggle': "validator", role: "form"});
  var $alert = $('<div/>', {role: "alert", class: "alert alert-danger", style: 'display: none;'});
  var $success = $('<div/>', {role: "alert", class: "alert alert-success", style: 'display: none;'});
  $modal.find('.modal-body').append($alert);
  $modal.find('.modal-body').append($success);

  var $inputs = {
    'name': $('<input/>', {class: 'form-control', id: 'feedback-name', required: true, type: 'text'}),
    'age': $('<input/>', {class: 'form-control', id: 'feedback-age', required: true, type: 'number'}),
    'phone': $('<input/>', {class: 'form-control', id: 'feedback-phone', required: true, type: 'number'}),
    'question': $('<textarea/>', {class: 'form-control', id: 'feedback-question', required: false}),
  };
  
  var $labels = {
    'name': $('<label/>', {for: 'feedback-name', text: 'Имя', class: 'control-label'}),
    'age': $('<label/>', {for: 'feedback-age', text: 'Возраст', class: 'control-label'}),
    'phone': $('<label/>', {for: 'feedback-phone', text: 'Телефон', class: 'control-label'}),
    'question': $('<label/>', {for: 'feedback-question', text: 'Ваш вопрос', class: 'control-label'})
  };

  var $formGroup = $('<div/>', {class: 'form-group'});
  var $button = $('<button/>', {class: 'btn btn-primary', 'data-loading-text': 'Отправляю данные...', 'text': 'Отправить'});

  for(var $inputKey in $inputs) {
    var $input = $inputs[$inputKey];
    var $label = $labels[$inputKey];
    var $row = $formGroup.clone();

    if ($input.attr('required')) {
      $row.addClass('required');
    }

    if ($label) {
      $row.append($label);
    }
    
    $row.append($input);
    
    $form.append($row);
  }

  var $acceptRow = $('<div/>', {class: 'form-group'});
  var $acceptInput = $('<input/>', {type: 'checkbox', 'id': 'accept', checked: true});
  var $acceptLabel = $('<label/>', {from: 'accept', class: 'control-label', html: '&nbsp;Я даю свое согласие на <a href="/soglasie-na-obrabotku-personalnyh-dannyh.html" target="_blank">обработку персональных данных</a>'});
  $acceptLabel.prepend($acceptInput);
  $acceptRow.append($acceptLabel);
  $form.append($acceptRow);

  function handler(event) {
    event.preventDefault();
    // Попытка отправить форму
    yaCounter38753525.reachGoal('FEEDBACK_FORM_SEND');

    $alert.hide();
    var requireds = false;
    var data = {};

    for(var $inputKey in $inputs) {
      var $input = $inputs[$inputKey];
      if ($input.attr('required')) {
        if (!$input.val()) {
          requireds = true;
        }
      }

      data[$inputKey] = $input.val();
    }

    if (requireds) {
      $alert.text('Заполните поля отмеченные звездочкой').show();
      return;
    }

    var isAccept = $acceptInput.prop('checked');
    if (!isAccept) {
      $alert.text('Подтвердите свое согласие на обработку персональных данных').show();
      return; 
    }

    $button.button('loading');
    var xhr = $.post('/feedback/add', data);
    xhr.then(function(res) {
      if (res && res.ok) {
        // Успех при отправке формы
        yaCounter38753525.reachGoal('FEEDBACK_FORM_SECCUESS');
        
        $form.remove();
        $success.text('Спасибо за ваше обращение, в ближайшее время с вами свяжется Инструктор для уточнения вопросов и записи.').show();
        setTimeout(function() {
          $modal.modal('hide');
        }, 5000);
      }
    }).fail(function(err) {
      // Ошибка при отправке формы
      yaCounter38753525.reachGoal('FEEDBACK_FORM_ERROR');

      if (err.status >= 500) {
        $alert.text('На сервере возникли ошибки. Пожалуйста, повторите позже.').show();
        return;
      }

      if (err.status == 422) {
        $alert.text('Заполните обязательные поля.').show();
        return;
      }
    }).always(function() {
      $button.button('reset');
    });
  }

  $form.append($button);
  $form.submit(handler);

  $modal.find('.modal-title').html('Обратная связь');
  $modal.find('.modal-body').append($form);
  $modal.modal('show');
}