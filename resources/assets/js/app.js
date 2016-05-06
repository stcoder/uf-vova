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
var $navbar = $('#navbar > ul');
var clickMenu = function() {
  $('a.nav-control').click(function(event) {
    var section = $(this).data('nav-section') || 'slider';

    $('html, body').animate({
      scrollTop: $('[data-section="'+section+'"]').offset().top
    }, 500);

    if ($navbar.is(':visible')) {
      $navbar.removeClass('in');
      $navbar.attr('aria-expanded', 'false');
    }

    event.preventDefault();
    return false;
  });
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
    $el.find('.history-body-title').addClass('animated fadeInDown');
    $el.find('.history-body-content').addClass('animated fadeInUp');
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
  var $items = $('.action-next-loader');

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
  var $posts = $('#posts');
  if (res.items) {
    $.each(res.items, function(col, item) {
      $posts.find('.--' + col).append(item);
    });
  }
}
loadNextItems();
/** End load next items **/

/** Start show attachment modal **/
var $posts = $('#posts');
var $modal = $("#modal");
var isShown = false;
var $modal_body = $modal.find('.modal-body');
var attachmentXhr = null;

$modal.on('shown.bs.modal', function() {
  isShown = true;
});

$modal.on('hide.bs.modal', function(e) {
  $modal_body.html('');
  window.history.pushState(null, '', '/');
  isShown = false;
});

function showAttachment(el) {
  var $el = $(el);
  window.history.pushState({href: $el.attr('href')}, '', $el.attr('href'));
  openModal($el.attr('href'));
  return false;
}
window.showAttachment = showAttachment;
window.onpopstate = function(popstate) {
  if (popstate.state == null || $.isEmptyObject(popstate.state)) {
    if (isShown)
      $modal.modal('hide');
  } else {
    openModal(popstate.state.href);
  }
};

function openModal(href) {
  $modal_body.html('<p>Загружаю...</p>');
  $modal.modal('show');

  if (attachmentXhr) {
    attachmentXhr.abort();
  }

  attachmentXhr = $.get('/show_attachment' + href);
  attachmentXhr.success(function(html) {
    if (html) {
      $modal_body.html(html);
      $modal_body.find('.carousel').carousel();
    }
  }).error(function(err, type, message) {
    $modal_body.html(message);
  }).always(function() {
  });
}
/** End show attachment modal **/