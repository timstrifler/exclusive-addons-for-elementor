// Testimonial Carousel
var TestimonialCarousel = function ($scope, $) {
    var $testimonialCarouselWrapper = $scope.find('.exad-testimonial-carousel-wrapper').eq(0),
    $loop = ($testimonialCarouselWrapper.data("loop") !== undefined) ? $testimonialCarouselWrapper.data("loop") : false,
    $responsiveTestimonial =  ( $testimonialCarouselWrapper.data("testimonial-preset") == '-circle' ) ? 2 : 1,
    $slidesToShow = ($testimonialCarouselWrapper.data("slidestoshow") !== undefined) ? $testimonialCarouselWrapper.data("slidestoshow") : 1,
    $slidesToScroll = ($testimonialCarouselWrapper.data("slidestoscroll") !== undefined) ? $testimonialCarouselWrapper.data("slidestoscroll") : 1,
    $autoPlay = ($testimonialCarouselWrapper.data("autoplay") !== undefined) ? $testimonialCarouselWrapper.data("autoplay") : false,
    $autoplaySpeed = ($testimonialCarouselWrapper.data("autoplayspeed") !== undefined) ? $testimonialCarouselWrapper.data("autoplayspeed") : false,
    $transitionSpeed = $testimonialCarouselWrapper.data("speed"),
    $dots = ($testimonialCarouselWrapper.data("carousel-dot") !== undefined) ? $testimonialCarouselWrapper.data("carousel-dot") : false,
    $pauseOnHover = ($testimonialCarouselWrapper.data("pauseOnHover") !== undefined) ? $testimonialCarouselWrapper.data("pauseOnHover") : false;

    $testimonialCarouselWrapper.slick({
        infinite: $loop,
        slidesToShow: $slidesToShow,
        slidesToScroll: $slidesToScroll,
        autoplay: $autoPlay,
        autoplaySpeed: $autoplaySpeed,
        speed: $transitionSpeed,
        pauseOnHover: $pauseOnHover,
        dots: $dots,
          prevArrow: "<div class='exad-testimonial-carousel-prev'><i class='fa fa-angle-left'></i></div>",
          nextArrow: "<div class='exad-testimonial-carousel-next'><i class='fa fa-angle-right'></i></div>",
          customPaging: function (slider, i) {
            var image = $(slider.$slides[i]).data('image');
            return '<a><img src="'+ image +'"></a>';
          },
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: $responsiveTestimonial,
                },
            },	
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ],
    });	
};