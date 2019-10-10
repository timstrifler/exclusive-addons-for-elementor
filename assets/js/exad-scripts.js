(function ($) {
    "use strict";

    var editMode = false;
    
// Accordion one script
var ExclusiveAccordion = function($scope, $) {
    var $accordionTitle = $scope.find('.exad-accordion-title');

    // Open default actived tab
    $accordionTitle.each(function(){
        if($(this).hasClass('active-default')){
            $(this).addClass('active');
            $(this).next('.exad-accordion-content').slideDown();
        }
    });
    
    // Remove multiple click event for nested accordion
    $accordionTitle.unbind("click");

    //$accordionWrapper.children('.exad-accordion-content').first().show();
    $accordionTitle.click(function(e){
        e.preventDefault();
        if ($(this).hasClass("active")) {
            $(this).removeClass('active');
            $(this).next().slideUp(400);
        } else {
            $(this).parent().parent().find(".exad-accordion-title").removeClass("active");
            $(this).parent().parent().find(".exad-accordion-content").slideUp(400);
            $(this).toggleClass("active");
            $(this).next().slideToggle(400);
        }	
    });        
};
//Exclusive Alert
var ExclusiveAlert = function( $scope, $ ) {
    var $alertClose = $scope.find('[data-alert]').eq(0);
    $alertClose.each( function(index){
        var alert = $(this);
        alert.find('.exad-alert-element-dismiss-icon').click(function(e){
            e.preventDefault();
            alert.fadeOut(500);
        });
        alert.find('.exad-alert-element-dismiss-button').click(function(e){
            e.preventDefault();
            alert.fadeOut(500);
        });
    });
};
// Animated text script start

var AnimatedText = function( $scope, $ ) {
  
  	var $animatedWrapper = $scope.find('.exad-typed-strings').eq(0),
		$animateSelectorId = $animatedWrapper.find('.exad-animated-text-animated-heading'),
		$animationType = $animatedWrapper.data('heading_animation'),
		$animationStyle = $animatedWrapper.data('animation_style'),
		$animationSpeed = $animatedWrapper.data('animation_speed'),
		$typeSpeed = $animatedWrapper.data('type_speed'),
		$startDelay = $animatedWrapper.data('start_delay'),
		$backTypeSpeed = $animatedWrapper.data('back_type_speed'),
		$backDelay = $animatedWrapper.data('back_delay'),
		$loop = $animatedWrapper.data("loop") ? true : false,
		$showCursor = $animatedWrapper.data("show_cursor") ? true : false,
		$fadeOut = $animatedWrapper.data("fade_out") ? true : false,
		$smartBackspace = $animatedWrapper.data("smart_backspace") ? true : false;
		
		var $id = $animateSelectorId.attr('id');

	if( $animationType === 'exad-typed-animation' ){
		var typed = new Typed( '#'+$id, {
			strings: $animatedWrapper.data('type_string'),
			loop: $loop,
			typeSpeed: $typeSpeed,
			backSpeed: $backTypeSpeed,
			showCursor : $showCursor,
			fadeOut : $fadeOut,
			smartBackspace : $smartBackspace,
			startDelay : $startDelay,
			backDelay : $backDelay,
		});
	}

	if( $animationType === 'exad-morphed-animation' ){
		$($animateSelectorId).Morphext({
			animation: $animationStyle,
			speed: $animationSpeed,
		});
	}
};

// Animated text script end
// Exclusive Button 
var ExclusiveButton = function($scope, $) {
    // position on hover a button in button style seven
    var $mouseHoverEffect8 = $scope.find('.effect-8.mouse-hover-effect').eq(0);
    
    $mouseHoverEffect8.on('mouseenter', function (e) {
          var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
          $(this).find('.effect-8-position').css({ top: relY, left: relX })
    });
    $mouseHoverEffect8.on('mouseout', function (e) {
          var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
          $(this).find('.effect-8-position').css({ top: relY, left: relX })
    });
      // position on hover a button in button style seven
};
// Countdown Timer
var CountdownTimer = function ($scope, $) {
    var $countdownTimerWrapper = $scope.find('[data-countdown]').eq(0);

    if (typeof $countdownTimerWrapper !== 'undefined' && $countdownTimerWrapper !== null) {		
        var $this = $countdownTimerWrapper,
            finalDate = $this.data('countdown'),
            day = $this.data('day'),
            hours = $this.data('hours'),
            minutes = $this.data('minutes'),
            seconds = $this.data('seconds');

        $this.countdown(finalDate, function (event) {
            $(this).html(event.strftime(' ' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%-D </span><span class="exad-countdown-title">' + day + '</span></div>' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%H </span><span class="exad-countdown-title">' + hours + '</span></div>' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%M </span><span class="exad-countdown-title">' + minutes + '</span></div>' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%S </span><span class="exad-countdown-title">' + seconds + '</span></div>'));
        }).on('finish.countdown', function (event) {
            $(this).html("<p class='message'>Hurrey! This is event day</p>");
        });
    }
};
// Counter Up Js
var CounterUp = function($scope, $) {
    var $counterUp = $scope.find('.exad-counter').eq(0),
        $exadCounterTime = $counterUp.data('counter-speed');

    $counterUp.counterUp({
        delay: 10,
        time: $exadCounterTime,
    });		
};
// Filterable gallery
var FilterableGallery = function( $scope, $ ) {

    var $galleryWrapper = $scope.find('#exad-gallery-one').eq(0),
        $galleryElement = $galleryWrapper.find('.exad-gallery-element'),
        $galleryFilter = $galleryWrapper.find('#filters'),
        $galleryMenu = $galleryWrapper.find('.exad-gallery-menu');

    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt( number, 10 ) > 50;
        },
        // show if name ends with -ium
        ium: function() {
        var name = $(this).find('.name').text();
        return name.match( /ium$/ );
        }
    };    

    var $gallery = $galleryElement.isotope({
        itemSelector: '#exad-gallery-one .exad-gallery-item',
        layoutMode: 'fitRows',
        getSortData: {
          name: '.name',
          symbol: '.symbol',
          number: '.number parseInt',
          category: '[data-category]',
          weight: function( itemElem ) {
            var weight = $( itemElem ).find('.weight').text();
            return parseFloat( weight.replace( /[\(\)]/g, '') );
          }
        }
    });

    // bind filter button click
    $galleryFilter.on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        $gallery.isotope({ filter: filterValue });
    });

    // change is-checked class on buttons
    $galleryMenu.each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $( this ).addClass('is-checked');
        });
    });

};


// Google Maps
var GoogleMaps = function($scope, $) {
    var $googleMaps = $scope.find('.exad-google-maps').eq(0),
        $latitude = $googleMaps.data('exad-lat'),
        $longitude = $googleMaps.data('exad-lng'),
        $mapTheme = $googleMaps.data('exad-theme'),
        $mapAddressType = $googleMaps.data('exad-address-type'),
        $mapZoom  = $googleMaps.data('exad-zoom'),
        $mapAddress = $googleMaps.data('exad-address'),
        $map_streeview_control  = $googleMaps.data('exad-streeview-control'),
        $map_type_control       = $googleMaps.data('exad-type-control'),
        $map_zoom_control       = $googleMaps.data('exad-zoom-control'),
        $map_fullscreen_control = $googleMaps.data('exad-fullscreen-control'),
        $map_scroll_zoom        = $googleMaps.data('exad-scroll-zoom');
        

    if ( $mapAddressType == 'address' ) {
        var $address = $mapAddress;
        var $center =  null;
    } else {
        var $center = [$latitude, $longitude];
        var $address = false;
    } 

    $googleMaps.gmap3({
        center: $center,
        address: $address,
        zoom: $mapZoom,
        streetViewControl: $map_streeview_control,
        mapTypeControl: $map_type_control,
        zoomControl: $map_zoom_control,
        fullscreenControl: $map_fullscreen_control,
        scrollwheel: $map_scroll_zoom,
        mapTypeId: $mapTheme,
    }).marker(function (map) {
        return {
            position: map.getCenter(),
        };
    }).styledmaptype(
        "standard",
        [],
        {name: "standard"}
      ).styledmaptype(
        "retro",
        [{"elementType":"geometry","stylers":[{"color":"#ebe3cd"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#523735"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f1e6"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"color":"#dcd2be"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ae9e90"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#93817c"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#a5b076"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#447530"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#f5f1e6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#f8c967"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#e9bc62"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#e98d58"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#db8555"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#806b63"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"transit.line","elementType":"labels.text.fill","stylers":[{"color":"#8f7d77"}]},{"featureType":"transit.line","elementType":"labels.text.stroke","stylers":[{"color":"#ebe3cd"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#b9d3c2"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#92998d"}]}],
        {name: "retro"}
      ).styledmaptype(
        "silver",
        [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}],
        {name: "silver"}
      ).styledmaptype(
        "dark",
        [{"elementType":"geometry","stylers":[{"color":"#212121"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#212121"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#757575"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"administrative.land_parcel","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#181818"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"poi.park","elementType":"labels.text.stroke","stylers":[{"color":"#1b1b1b"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#8a8a8a"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#373737"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#3c3c3c"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#3d3d3d"}]}],
        {name: "dark"}
      ).styledmaptype(
        "night",
        [{"elementType":"geometry","stylers":[{"color":"#242f3e"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#746855"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#242f3e"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#263c3f"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#6b9a76"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#38414e"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#212a37"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#9ca5b3"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#746855"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#1f2835"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#f3d19c"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2f3948"}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#17263c"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#515c6d"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#17263c"}]}],
        {name: "night"}
      ).styledmaptype(
        "aubergine",
        [{"elementType":"geometry","stylers":[{"color":"#1d2c4d"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#8ec3b9"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#1a3646"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#64779e"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#334e87"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#023e58"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#283d6a"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#6f9ba5"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#023e58"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#3C7680"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#304a7d"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2c6675"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#255763"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#b0d5ce"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#023e58"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"transit.line","elementType":"geometry.fill","stylers":[{"color":"#283d6a"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#3a4762"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0e1626"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#4e6d70"}]}],
        {name: "aubergine"}
      );
};
// Image Comparison
var ImageComparison = function($scope, $) {
    var $imageComparison = $scope.find('.exad-image-comparision-element').eq(0),
        $exadOrientation = $imageComparison.data('exad-oriantation'),
        $exadBeforeLabel = $imageComparison.data('exad-before_label'),
        $exadAfterLabel = $imageComparison.data('exad-after_label'),
        $exadDefaultOffsetPct = $imageComparison.data('exad-default_offset_pct'),
        $exadNoOverlay = $imageComparison.data('exad-no_overlay');
        
    $imageComparison.twentytwenty({
        orientation: $exadOrientation,
        before_label: $exadBeforeLabel,
        after_label: $exadAfterLabel,
        default_offset_pct: $exadDefaultOffsetPct,
        no_overlay: $exadNoOverlay,
    });
};
// Image Hotspot
var ImageHotspot = function ($scope, $) {
    var $hotspotWrapper = $scope.find('.exad-hotspot').eq(0),
        $hotspotItem = $hotspotWrapper.find('.exad-hotspot-dot');

    // hostpot script
    $hotspotItem.each( function(){
        var leftPos = $(this).data('left');
        var topPos = $(this).data('top');
        $(this).css({ "left" : leftPos, "top" : topPos });
    });
    
};
//Instagram Gallery
var InstagramGallery = function( $scope, $ ) {
    var $feed = $scope.find('#instafeed').eq(0);
    $feed.each(function(){
        var limit = $(this).data('limit');
        var template = $(this).data('template');
        var token = $(this).data('token');
        var userId = $(this).data('user-id');
        var userFeed = new Instafeed({
            get: 'user',
            userId: userId,
            limit: limit,
            resolution: 'standard_resolution',
            accessToken: token,
            sortBy: 'most-recent',
            template: template,
        });
        userFeed.run();
    });
};
// Logo Carousel
var LogoCarousel = function ($scope, $) {
    var $logoCarouselWrapper = $scope.find('.exad-logo-carousel-element').eq(0),
        $slidesToShow = $logoCarouselWrapper.data('slidestoshow'),
        $slidesToScroll = $logoCarouselWrapper.data('slidestoscroll'),
        $carousel_nav = $logoCarouselWrapper.data('carousel-nav'),
        $loop = ($logoCarouselWrapper.data("loop") !== undefined) ? $logoCarouselWrapper.data("loop") : false,
        $autoPlay = ($logoCarouselWrapper.data("autoplay") !== undefined) ? $logoCarouselWrapper.data("autoplay") : false,
        $autoplaySpeed = ($logoCarouselWrapper.data("autoplayspeed") !== undefined) ? $logoCarouselWrapper.data("autoplayspeed") : false;
        // $transitionSpeed = $logoCarouselWrapper.data("speed");
    // $pauseOnHover = ($logoCarouselWrapper.data("pauseOnHover") !== undefined) ? $logoCarouselWrapper.data("pauseOnHover") : false;

    if ($carousel_nav == "arrows" ) {
        var arrows = true;
        var dots = false;
    } else {
        var arrows = false;
        var dots = true;
    }

    console.log($logoCarouselWrapper);

    $logoCarouselWrapper.slick({
        infinite: $loop,
        slidesToShow: $slidesToShow,
        slidesToScroll: $slidesToScroll,
        autoplay: $autoPlay,
        autoplaySpeed: $autoplaySpeed,
        dots: dots,
          arrows: arrows,
          prevArrow: "<div class='exad-logo-carousel-prev'><i class='fa fa-angle-left'></i></div>",
          nextArrow: "<div class='exad-logo-carousel-next'><i class='fa fa-angle-right'></i></div>",
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 450,
              settings: {
                slidesToShow: 1,
              }
            }
        ],
    });	
};



var ModalPopup = function ($scope, $) {
    var $modalWrapper = $scope.find('.exad-modal-trigger').eq(0);
        //$modalAction = $modalWrapper.find('.exad-modal-image-action');
    
    $modalWrapper.magnificPopup({
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });

};

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
                direction: direction,
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

function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth){
    var triggerClass = '.exad-progress-bar-'+id;
    if("line" == type) {
        new ldBar(triggerClass, {
            "type"              : 'stroke',
            "path"              : 'M0 10L100 10',
            "aspect-ratio"      : 'none',
            "stroke"			: strokeColor,
            "stroke-trail"	    : trailColor,
            "stroke-width"      : strokeWidth,
            "stroke-trail-width": strokeTrailWidth
        }).set(value);
    }
    if("line-bubble" == type) {
        new ldBar(triggerClass, {
            "type"              : 'stroke',
            "path"              : 'M0 10L100 10',
            "aspect-ratio"      : 'none',
            "stroke"			: strokeColor,
            "stroke-trail"		: trailColor,
            "stroke-width"      : strokeWidth,
            "stroke-trail-width": strokeTrailWidth
        }).set(value);
        $($('.exad-progress-bar-'+id).find('.ldBar-label')).animate({
            left: value + '%'
        }, 1000, 'swing');
    }
    if("circle" == type){
        new ldBar(triggerClass, {
            "type"				: 'stroke',
            "path"			    : 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
            "stroke-dir"		: 'normal',
            "stroke"		    : strokeColor,
            "stroke-trail"	    : trailColor,
            "stroke-width"	    : strokeWidth,
            "stroke-trail-width": strokeTrailWidth,
        }).set(value);
    }
    if("fan" == type){
        new ldBar(triggerClass, {
            "type": 'stroke',
            "path": 'M10 90A40 40 0 0 1 90 90',
            "stroke": strokeColor,
            "stroke-trail": trailColor,
            "stroke-width": strokeWidth,
            "stroke-trail-width": strokeTrailWidth,
        }).set(value);
    }
};

var ProgressBar = function ($scope, $){
    var $progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
    $progressBarWrapper.waypoint(function () {
        var element = $(this.element);
        var id = element.data('id');
        var type = element.data('type');
        var value = element.data('progress-bar-value');
        var strokeWidth = element.data('progress-bar-stroke-width');
        var strokeTrailWidth = element.data('progress-bar-stroke-trail-width');
        var color = element.data('stroke-color');
        var trailColor = element.data('stroke-trail-color');
        animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
        this.destroy();
    }, {
        offset: 'bottom-in-view'
    });
};
// Exclusive Tabs script
var ExclusiveTabs = function($scope, $) {
    var $tabsWrapper = $scope.find('[data-tabs]').eq(0);
    $tabsWrapper.each( function() {
        var tab = $(this);
        var isTabActive = false;
        var isContentActive = false;
        tab.find('[data-tab]').each( function (){
            if($(this).hasClass('active')){
                isTabActive = true;
            }
        });
        tab.find('.exad-advance-tab-content').each( function (){
            if($(this).hasClass('active')){
                isContentActive = true;
            }
        });
        if(!isContentActive){
            tab.find('.exad-advance-tab-content').eq(0).addClass('active');
        }
        if(!isTabActive){
            tab.find('[data-tab]').eq(0).addClass('active');
        }
        tab.find('[data-tab]').click(function() {
            tab.find('[data-tab]').removeClass('active');
            tab.find('.exad-advance-tab-content').removeClass('active');
            $(this).addClass('active');
            tab.find('.exad-advance-tab-content').eq($(this).index()).addClass('active');
        });
    });
};

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

// Testimonial Carousel
var TestimonialCarousel = function ($scope, $) {
    var $testimonialCarouselWrapper = $scope.find('.exad-testimonial-carousel-wrapper').eq(0),
    $carousel_nav = $testimonialCarouselWrapper.data("carousel-nav"),
    $loop = ($testimonialCarouselWrapper.data("loop") !== undefined) ? $testimonialCarouselWrapper.data("loop") : false,
    $slidesToShow = ($testimonialCarouselWrapper.data("slidestoshow") !== undefined) ? $testimonialCarouselWrapper.data("slidestoshow") : 1,
    $slidesToScroll = $testimonialCarouselWrapper.data("slidestoscroll"),
    $autoPlay = ($testimonialCarouselWrapper.data("autoplay") !== undefined) ? $testimonialCarouselWrapper.data("autoplay") : false,
    $autoplaySpeed = ($testimonialCarouselWrapper.data("autoplayspeed") !== undefined) ? $testimonialCarouselWrapper.data("autoplayspeed") : false,
    $transitionSpeed = $testimonialCarouselWrapper.data("speed"),
    $pauseOnHover = ($testimonialCarouselWrapper.data("pauseonhover") !== undefined) ? $testimonialCarouselWrapper.data("pauseonhover") : false,
    $centerMode = ($testimonialCarouselWrapper.data("centermode") !== undefined) ? $testimonialCarouselWrapper.data("centermode") : false;
	
	if ($carousel_nav == "both" ) {
        var arrows = true;
        var dots = true;
    } else if ($carousel_nav == "arrows" ) {
        var arrows = true;
        var dots = false;
    } else if ($carousel_nav == "nav-dots" ) {
        var arrows = false;
        var dots = true;
    } else if ($carousel_nav == "none" ) {
        var arrows = false;
        var dots = false;
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
$(window).on('elementor/frontend/init', function () {
    if( elementorFrontend.isEditMode() ) {
        editMode = true;
    }
    
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-team-carousel.default', TeamCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-testimonial-carousel.default', TestimonialCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-progress-bar.default', ProgressBar);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-countdown-timer.default', CountdownTimer);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-accordion.default', ExclusiveAccordion);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-tabs.default', ExclusiveTabs);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-button.default', ExclusiveButton);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-post-carousel.default', PostCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-google-maps.default', GoogleMaps);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-comparison.default', ImageComparison);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-counter.default', CounterUp);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-logo-carousel.default', LogoCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-modal-popup.default', ModalPopup);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-filterable-gallery.default', FilterableGallery);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-alert.default', ExclusiveAlert);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-instagram-feed.default', InstagramGallery);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-news-ticker.default', ExadNewsTicker );
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-animated-text.default', AnimatedText);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-hotspot.default', ImageHotspot);
});	

}(jQuery));