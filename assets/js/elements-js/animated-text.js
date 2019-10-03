// Animated text script start
var AnimatedText = function( $scope, $ ) {
  
  	var $animatedWrapper = $scope.find('.typed-strings').eq(0),
		$animateSelectorId = $animatedWrapper.find('.exad-animated-text-animated-heading');

		var $id = $animateSelectorId.attr('id');

	// console.log( $animateSelectorId );

	var typed = new Typed( '#'+$id, {
		strings: $animatedWrapper.data('type_string'),
		loop: true,
		typeSpeed: 50,
		backSpeed: 50,
	});
};

// var $animatedHeading = $scope.find( '.bdt-heading > * > .bdt-animated-heading' );
				
// 			if ( ! $animatedHeading.length ) {
// 				return;
// 			}

//     		if ( $animatedHeading.data('heading_layout') == 'animated' ) {
// 				$($animatedHeading).Morphext({
// 				    animation : $animatedHeading.data('heading_animation'), 
// 				    speed     : $animatedHeading.data('heading_animation_delay'),
// 				});
// 			} else if ( $animatedHeading.data('heading_layout') == 'typed' ) {
// 				var animateSelector = $($animatedHeading).attr('id');
// 				var typed = new Typed('#'+animateSelector, {
// 				  strings    : $animatedHeading.data('animate_text'),
// 				  typeSpeed  : $animatedHeading.data('type_speed'),
// 				  startDelay : $animatedHeading.data('start_delay'),
// 				  backSpeed  : $animatedHeading.data('back_speed'),
// 				  backDelay  : $animatedHeading.data('back_delay'),
// 				  loop       : $animatedHeading.data('type_loop'),
// 				  loopCount  : $animatedHeading.data('type_loop_count'),
// 				});
// 			}
// Animated text script end