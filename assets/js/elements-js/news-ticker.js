// news ticker script starts

var exclusiveNewsTicker = function( $scope, $ ) {

    var exad_news_ticker = $scope.find( '.exad-news-ticker' );

    if ( $.isFunction( $.fn.breakingNews ) ) {  
        exad_news_ticker.each( function() {
            var t            = $(this),
            auto             = t.data( 'autoplay' ) ? !0 : !1,
            animationEffect  = t.data( 'animation' ) ? t.data( 'animation' ) : '',                                   
            fixedBottom      = t.data( 'bottom_fixed' ) ? t.data( 'bottom_fixed' ) : '',                                   
            pauseOnHover     = t.data( 'pause_on_hover' ) ? t.data( 'pause_on_hover' ) : '',                                   
            animationSpeed   = t.data( 'animation_speed' ) ? t.data( 'animation_speed' ) : '',                                   
            autoplayInterval = t.data( 'autoplay_interval' ) ? t.data( 'autoplay_interval' ) : '',                                   
            height           = t.data( 'ticker_height' ) ? t.data( 'ticker_height' ) : '',                                   
            direction        = t.data( 'direction' ) ? t.data( 'direction' ) : ''; 

            $(this).breakingNews( {
                position: fixedBottom,
                play: auto,
                direction: direction,
                scrollSpeed: animationSpeed,
                stopOnHover: pauseOnHover,
                effect: animationEffect,
                delayTimer: autoplayInterval,                    
                height: height,
                fontSize: 'default',
                themeColor: 'default',
                background: 'default'             
            } );    
        } );
    }
};

// news ticker script ends
