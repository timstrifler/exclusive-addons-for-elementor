// Post Carousel 
var PostCarousel = function($scope, $) {
    var $postCarouselWrapper = $scope.find('.exad-post-carousel').eq(0),
        $postCarouselColumn = $postCarouselWrapper.data("carousel-column"),
        $postCarouselNav = $postCarouselWrapper.data("post-carousel-nav"),
        $loop = ($postCarouselWrapper.data("loop") !== undefined) ? $postCarouselWrapper.data("loop") : false,
        $autoPlay = ($postCarouselWrapper.data("autoplay") !== undefined) ? $postCarouselWrapper.data("autoplay") : false,
        $autoplaySpeed = ($postCarouselWrapper.data("autoplayspeed") !== undefined) ? $postCarouselWrapper.data("autoplayspeed") : false,
        $transitionSpeed = $postCarouselWrapper.data("post-carousel-speed"),
        $pauseOnHover = ($postCarouselWrapper.data("pauseonhover") !== undefined) ? $postCarouselWrapper.data("pauseonhover") : false;

    // Post Carousel 
    if ($postCarouselNav == "both" ) {
        var arrows = true;
        var dots = true;
    } else if ($postCarouselNav == "arrows" ) {
        var arrows = true;
        var dots = false;
    } else if ($postCarouselNav == "dots" ) {
        var arrows = false;
        var dots = true;
    } else {
        var arrows = false;
        var dots = true;
    }
    
    // post Carousel one
    $postCarouselWrapper.slick({
        slidesToShow: $postCarouselColumn,
        arrows: arrows,
        autoplay: $autoPlay,
        autoplaySpeed: $autoplaySpeed,
        pauseOnHover: $pauseOnHover,
        dots: dots,
        arrows: arrows,
        speed: $transitionSpeed,
        infinite: $loop,
        prevArrow: "<div class='exad-post-carousel-prev'><i class='fa fa-angle-left'></i></div>",
        nextArrow: "<div class='exad-post-carousel-next'><i class='fa fa-angle-right'></i></div>",
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                slidesToShow: 2,
                }
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
