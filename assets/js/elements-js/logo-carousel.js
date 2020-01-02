// Logo Carousel
var exclusiveLogoCarousel = function ($scope, $) {

    var logoCarouselWrapper = $scope.find( '.exad-logo-carousel-element' ).eq(0),
    slidesToShow            = logoCarouselWrapper.data( 'slidestoshow' ),
    slidesToScroll          = logoCarouselWrapper.data( 'slidestoscroll' ),
    carouselNav             = logoCarouselWrapper.data( 'carousel-nav' ),
    loop                    = ( logoCarouselWrapper.data( 'loop' ) !== undefined ) ? logoCarouselWrapper.data( 'loop' ) : false,
    autoPlay                = ( logoCarouselWrapper.data( 'autoplay' ) !== undefined ) ? logoCarouselWrapper.data( 'autoplay' ) : false,
    autoplaySpeed           = ( logoCarouselWrapper.data( 'autoplayspeed' ) !== undefined ) ? logoCarouselWrapper.data( 'autoplayspeed' ) : false;

    var arrows, dots;
    if ( 'both' === carouselNav ) {
        arrows = true;
        dots   = true;
    } else if ( 'arrows' === carouselNav ) {
        arrows = true;
        dots   = false;
    } else if ( 'dots' === carouselNav ) {
        arrows = false;
        dots   = true;
    } else {
        arrows = false;
        dots   = false;
    }

    if ( $.isFunction($.fn.slick) ) {
        logoCarouselWrapper.slick({
            infinite: loop,
            slidesToShow: slidesToShow,
            slidesToScroll: slidesToScroll,
            autoplay: autoPlay,
            autoplaySpeed: autoplaySpeed,
            dots: dots,
            arrows: arrows,
            prevArrow: '<div class="exad-logo-carousel-prev"><i class="eicon-chevron-left"></i></div>',
            nextArrow: '<div class="exad-logo-carousel-next"><i class="eicon-chevron-right"></i></div>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });	
    }
}

