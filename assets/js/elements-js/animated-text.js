// Animated text script start
var AnimatedText = function( $scope, $ ) {
  var typed = new Typed('#typed', {
    strings: ['Some <i>strings</i> with', 'Some <strong>HTML</strong>', 'Chars &times; &copy;'],
    loop: true,
    typeSpeed: 50,
    backSpeed: 50,
    // shuffle: true,
  });
};
// Animated text script end