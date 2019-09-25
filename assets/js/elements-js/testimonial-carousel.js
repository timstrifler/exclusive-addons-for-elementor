// Testimonial Carousel
var TestimonialCarousel = function ($scope, $) {
    var $testimonialCarouselWrapper = $scope.find('.exad-testimonial-carousel-wrapper').eq(0),
    $carousel_nav = $testimonialCarouselWrapper.data("carousel-nav"),
    $loop = ($testimonialCarouselWrapper.data("loop") !== undefined) ? $testimonialCarouselWrapper.data("loop") : false,
    $slidesToShow = ($testimonialCarouselWrapper.data("slidestoshow") !== undefined) ? $testimonialCarouselWrapper.data("slidestoshow") : 1,
    $slidesToScroll = ($testimonialCarouselWrapper.data("slidestoscroll") !== undefined) ? $testimonialCarouselWrapper.data("slidestoscroll") : 1,
    $autoPlay = ($testimonialCarouselWrapper.data("autoplay") !== undefined) ? $testimonialCarouselWrapper.data("autoplay") : false,
    $autoplaySpeed = ($testimonialCarouselWrapper.data("autoplayspeed") !== undefined) ? $testimonialCarouselWrapper.data("autoplayspeed") : false,
    $transitionSpeed = $testimonialCarouselWrapper.data("speed"),
    $dots = ($testimonialCarouselWrapper.data("carousel-dot") !== undefined) ? $testimonialCarouselWrapper.data("carousel-dot") : false,
    $pauseOnHover = ($testimonialCarouselWrapper.data("pauseonhover") !== undefined) ? $testimonialCarouselWrapper.data("pauseonhover") : false,
    $centerMode = ($testimonialCarouselWrapper.data("centermode") !== undefined) ? $testimonialCarouselWrapper.data("centermode") : false;

    if ($carousel_nav == "arrows" ) {
        var arrows = true;
        var dots = false;
    } else {
        var arrows = false;
        var dots = true;
    }

    $testimonialCarouselWrapper.slick({
        infinite: $loop,
        slidesToShow: $slidesToShow,
        slidesToScroll: $slidesToScroll,
        autoplay: $autoPlay,
        autoplaySpeed: $autoplaySpeed,
        speed: $transitionSpeed,
        pauseOnHover: $pauseOnHover,
        centerMode: $centerMode,
        centerPadding: '0',
        dots: dots,
        arrows: arrows,
        prevArrow: "<div class='exad-testimonial-carousel-prev'><i class='fa fa-angle-left'></i></div>",
        nextArrow: "<div class='exad-testimonial-carousel-next'><i class='fa fa-angle-right'></i></div>",
        rows: 0,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                arrows: false,
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                arrows: false,
              }
            }
        ],
    });	
};