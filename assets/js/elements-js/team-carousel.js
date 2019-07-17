var TeamCarousel = function ($scope, $) {
    var $teamCarouselWrapper = $scope.find('.exad-team-carousel-wrapper').eq(0),
    $carousel_nav = $teamCarouselWrapper.data("carousel-nav"),
    $loop = ($teamCarouselWrapper.data("loop") !== undefined) ? $teamCarouselWrapper.data("loop") : false,
    $slidesToShow = $teamCarouselWrapper.data("slidestoshow"),
    $slidesToScroll = $teamCarouselWrapper.data("slidestoscroll"),
    $autoPlay = ($teamCarouselWrapper.data("autoplay") !== undefined) ? $teamCarouselWrapper.data("autoplay") : false,
    $autoplaySpeed = ($teamCarouselWrapper.data("autoplayspeed") !== undefined) ? $teamCarouselWrapper.data("autoplayspeed") : false,
    $transitionSpeed = $teamCarouselWrapper.data("speed"),
    $pauseOnHover = ($teamCarouselWrapper.data("pauseonhover") !== undefined) ? $teamCarouselWrapper.data("pauseonhover") : false;

    // Team Carousel 
    if ($carousel_nav == "arrows" ) {
        var arrows = true;
        var dots = false;
    } else {
        var arrows = false;
        var dots = true;
    }

    $teamCarouselWrapper.slick({
        infinite: $loop,
        slidesToShow : $slidesToShow,
        slidesToScroll: $slidesToScroll,
        autoplay: $autoPlay,
        autoplaySpeed: $autoplaySpeed,
        speed: $transitionSpeed,
        pauseOnHover: $pauseOnHover,
          dots: dots,
          arrows: arrows,
          prevArrow: "<div class='exad-team-carousel-prev'><i class='fa fa-angle-left'></i></div>",
        nextArrow: "<div class='exad-team-carousel-next'><i class='fa fa-angle-right'></i></div>",
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
