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
var navigationSection = function() {

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