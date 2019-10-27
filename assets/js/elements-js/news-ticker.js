
/**
 * News Ticker
 */  
let ExadNewsTicker = function( $scope, $ ) {

    var $exad_news_ticker = $scope.find(".exad-news-ticker");

    if ( $.isFunction($.fn.breakingNews) ) {  
        $exad_news_ticker.each(function() {
            let t             = $(this),
            auto              = t.data("autoplay") ? !0 : !1,
            the_effect        = t.data("animation") ? t.data("animation") : '',                                   
            fixed_bottom      = t.data("bottom_fixed") ? t.data("bottom_fixed") : '',                                   
            pause_on_hover    = t.data("pause_on_hover") ? t.data("pause_on_hover") : '',                                   
            animation_speed   = t.data("animation_speed") ? t.data("animation_speed") : '',                                   
            autoplay_interval = t.data("autoplay_interval") ? t.data("autoplay_interval") : '',                                   
            ticker_height     = t.data("ticker_height") ? t.data("ticker_height") : '',                                   
            direction         = t.data("direction") ? t.data("direction") : ''; 

            $(this).breakingNews({
                position: fixed_bottom,
                play: auto,
                // direction: direction,
                scrollSpeed: animation_speed,
                stopOnHover: pause_on_hover,
                effect: the_effect,
                delayTimer: autoplay_interval,                    
                height: ticker_height,
                fontSize: "default",
                themeColor: "default",
                background: "default",                       
            });    
        });
    }
};