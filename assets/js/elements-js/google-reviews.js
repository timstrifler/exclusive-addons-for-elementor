
// Google Reviews Carousel
var exclusiveGoogleReviews = function( $scope, $ ) {

  var $slider = $scope.find( '.exad-google-reviews-carousel-wrapper' );
      
      if ( ! $slider.length ) {
          return;
      }

  var $sliderContainer = $slider.find('.swiper-container'),
    $settings 		 = $slider.data('settings');

  var swiper = new Swiper($sliderContainer, $settings);

  if ($settings.pauseOnHover) {
     $($sliderContainer).hover(function() {
      (this).swiper.autoplay.stop();
    }, function() {
      (this).swiper.autoplay.start();
    });
  }

};