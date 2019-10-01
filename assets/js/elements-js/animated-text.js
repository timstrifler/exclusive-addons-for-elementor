// Animated text script start
var AnimatedText = function( $scope, $ ) {
  
  var $animatedWrapper = $scope.find('#typed-strings').eq(0),
      $first_string = $animatedWrapper.data("first_string"),
      $second_string = $animatedWrapper.data("second_string");
      console.log($animatedWrapper);
  var typed = new Typed('#typed', {
    strings: [ $first_string, $second_string ],
    loop: true,
    typeSpeed: 50,
    backSpeed: 50,
    // shuffle: true,
  });
};
// Animated text script end