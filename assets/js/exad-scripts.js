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
		$animateSelector = $animatedWrapper.find('.exad-animated-text-animated-heading'),
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
		
		var $id = $animateSelector.attr('id');

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
		$($animateSelector).Morphext({
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
        var $this   = $countdownTimerWrapper,
        finalDate   = $this.data('countdown'),
        day         = $this.data('day'),
        hours       = $this.data('hours'),
        minutes     = $this.data('minutes'),
        seconds     = $this.data('seconds'),
        expiredText = $this.data('expired-text');

        $this.countdown(finalDate, function (event) {
            $(this).html(event.strftime(' ' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%-D </span><span class="exad-countdown-title">' + day + '</span></div>' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%H </span><span class="exad-countdown-title">' + hours + '</span></div>' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%M </span><span class="exad-countdown-title">' + minutes + '</span></div>' +
                '<div class="exad-countdown-container"><span class="exad-countdown-count">%S </span><span class="exad-countdown-title">' + seconds + '</span></div>'));
        }).on('finish.countdown', function (event) {
            $(this).html('<p class="message">'+ expiredText +'</p>');
        });
    }
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
    var $imageComparison  = $scope.find('.exad-image-comparision-element').eq(0),
    $exadOrientation      = $imageComparison.data('exad-oriantation'),
    $exadBeforeLabel      = $imageComparison.data('exad-before_label'),
    $exadAfterLabel       = $imageComparison.data('exad-after_label'),
    $exadDefaultOffsetPct = $imageComparison.data('exad-default_offset_pct'),
    $exadNoOverlay        = $imageComparison.data('exad-no_overlay');
        
    $imageComparison.twentytwenty({
        orientation: $exadOrientation,
        before_label: $exadBeforeLabel,
        after_label: $exadAfterLabel,
        default_offset_pct: $exadDefaultOffsetPct,
        no_overlay: $exadNoOverlay
    });
};

// Image Magnifier JS

var ImageMagnifier = function($scope, $) {

    var $magnify = $scope.find('.exad-image-magnify').eq(0),
        $large = $magnify.find('.exad-magnify-large'),
        $small = $magnify.find('.exad-magnify-small');
    

    var native_width = 0;
    var native_height = 0;
    $large.css("background","url('" + $small.attr("src") + "') no-repeat");
    
        //Now the mousemove function
        $magnify.mousemove(function(e){
            
            if(!native_width && !native_height) {
                var image_object = new Image();
                image_object.src = $small.attr("src");
                
                native_width = image_object.width;
                native_height = image_object.height;
            } else {
                var magnify_offset = $(this).offset();
                var mx = e.pageX - magnify_offset.left;
                var my = e.pageY - magnify_offset.top;
                
                //Finally the code to fade out the glass if the mouse is outside the container
                if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0){
                    $large.fadeIn(100);
                } else {
                    $large.fadeOut(100);
                }
                
                if($large.is(":visible")) {
                    
                    var rx = Math.round(mx/$small.width()*native_width - $large.width()/2)*-1;
                    var ry = Math.round(my/$small.height()*native_height - $large.height()/2)*-1;
                    var bgp = rx + "px " + ry + "px";
                    
                    //Time to move the magnifying glass with the mouse
                    var px = mx - $large.width()/2;
                    var py = my - $large.height()/2;
                    
                    $large.css({left: px, top: py, backgroundPosition: bgp});
                }
            }
        })
        
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

        if ( 'both' == $carousel_nav ) {
            var arrows = true;
            var dots = true;
        } else if ( 'arrows' == $carousel_nav ) {
            var arrows = true;
            var dots = false;
        } else if ( 'dots' == $carousel_nav ) {
            var arrows = false;
            var dots = true;
        } else {
            var arrows = false;
            var dots = false;
        }

    $logoCarouselWrapper.slick({
        infinite: $loop,
        slidesToShow: $slidesToShow,
        slidesToScroll: $slidesToScroll,
        autoplay: $autoPlay,
        autoplaySpeed: $autoplaySpeed,
        dots: dots,
        arrows: arrows,
        prevArrow: "<div class='exad-logo-carousel-prev'><i class='eicon-chevron-left'></i></div>",
        nextArrow: "<div class='exad-logo-carousel-next'><i class='eicon-chevron-right'></i></div>",
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
};



var ModalPopup = function ($scope, $) {

    var $modalWrapper = $scope.find('.exad-modal').eq(0),
            $modalAction = $modalWrapper.find('.exad-modal-image-action'),
            $closeButton = $modalWrapper.find('.exad-close-btn');

    $modalAction.on("click", function(e) {
        e.preventDefault();
        var $modalOverlay = $(this).parents().eq(1).next();
        var modal = $(this).data("exad-modal");
        
        var $overlay = $(this).data("exad-overlay");
        $('.exad-modal-item').css('display', 'block');
        setTimeout(() => {
            $(modal).addClass('active');
        }, 100);
        if ( $overlay == "yes" ) {
            $modalOverlay.addClass('active');
        }
        
    });

		// setTimeout(function() {
		// 		var $modalOverlay = $modalAction.parents().eq(1).next();
		// 		var modal = $modalAction.data("exad-modal");
				
		// 		var $overlay = $modalAction.data("exad-overlay");

		// 		$(modal).addClass('active');
		// 		if ( $overlay == "yes" ) {
		// 			$modalOverlay.addClass('active');
		// 		}
		// 	},5000
		// );

    $closeButton.click(function() {
        var $modalOverlay = $(this).parents().eq(3).next();
        var $modalItem = $(this).parents().eq(2);
        $modalOverlay.removeClass('active');
        $modalItem.removeClass('active');
        // setTimeout(() => {
        //     $('.exad-modal-item').css('display', 'none');
        // }, 500);

        var $modal_iframe 		= $modalWrapper.find( 'iframe' ),
            $modal_video_tag 	= $modalWrapper.find( 'video' );

            console.log($modal_iframe);

        if ( $modal_iframe.length ) {
            var $modal_src = $modal_iframe.attr( "src" ).replace( "&autoplay=1", "" );
            $modal_iframe.attr( "src", '' );
            $modal_iframe.attr( "src", $modal_src );
        }
        if ( $modal_video_tag.length ) {
            $modal_video_tag[0].pause();
            $modal_video_tag[0].currentTime = 0;
        }
        
    });

    $('.exad-modal-overlay').click(function(){
        var $overlay_click_close = $(this).data("exad_overlay_click_close");
        if( $overlay_click_close == "yes" ){
            $(this).removeClass('active');
            $('.exad-modal-item').removeClass('active');

            var $modal_iframe 		= $modalWrapper.find( 'iframe' ),
            $modal_video_tag 	= $modalWrapper.find( 'video' );

            console.log($modal_iframe);

            if ( $modal_iframe.length ) {
                var $modal_src = $modal_iframe.attr( "src" ).replace( "&autoplay=1", "" );
                $modal_iframe.attr( "src", '' );
                $modal_iframe.attr( "src", $modal_src );
            }
            if ( $modal_video_tag.length ) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }
        }
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
                background: "default"             
            });    
        });
    }
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

$(window).on('elementor/frontend/init', function () {
    if( elementorFrontend.isEditMode() ) {
        editMode = true;
    }
    
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-progress-bar.default', ProgressBar);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-countdown-timer.default', CountdownTimer);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-accordion.default', ExclusiveAccordion);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-tabs.default', ExclusiveTabs);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-button.default', ExclusiveButton);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-google-maps.default', GoogleMaps);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-comparison.default', ImageComparison);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-logo-carousel.default', LogoCarousel);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-modal-popup.default', ModalPopup);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-filterable-gallery.default', FilterableGallery);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-exclusive-alert.default', ExclusiveAlert);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-news-ticker.default', ExadNewsTicker );
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-animated-text.default', AnimatedText);
    elementorFrontend.hooks.addAction('frontend/element_ready/exad-image-magnifier.default', ImageMagnifier);
});	

}(jQuery));