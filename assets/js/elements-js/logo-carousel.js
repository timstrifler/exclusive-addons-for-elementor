// logo carousel script starts

var exclusiveLogoCarousel   = function ( $scope, $ ) {
    var logoCarouselWrapper = $scope.find( '.exad-logo-carousel-element' ).eq(0),
    slidesToShow            = logoCarouselWrapper.data( 'slidestoshow' ),
    slidesToScroll          = logoCarouselWrapper.data( 'slidestoscroll' ),
    carouselNav             = logoCarouselWrapper.data( 'carousel-nav' ),
    direction               = logoCarouselWrapper.data( 'direction' ),
    loop                    = undefined !== logoCarouselWrapper.data( 'loop' ) ? logoCarouselWrapper.data( 'loop' ) : false,
    autoPlay                = undefined !== logoCarouselWrapper.data( 'autoplay' ) ? logoCarouselWrapper.data( 'autoplay' ) : false,
    autoplaySpeed           = undefined !== logoCarouselWrapper.data( 'autoplayspeed' ) ? logoCarouselWrapper.data( 'autoplayspeed' ) : false;

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

    if ( $.isFunction( $.fn.slick ) ) {
        logoCarouselWrapper.slick( {
            infinite: loop,
            slidesToShow: slidesToShow,
            slidesToScroll: slidesToScroll,
            autoplay: autoPlay,
            autoplaySpeed: autoplaySpeed,
            dots: dots,
            rtl: direction,
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
        } );	
    }
}

// logo carousel script ends
