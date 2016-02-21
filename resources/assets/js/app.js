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
  $('a:not([class="external"])').click(function(event) {
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