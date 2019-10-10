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