// slider js starts here. 
var ExadSlider = function($scope, $) {
    var $ExadSliderWrapper = $scope.find('.exad-slider').eq(0);
    
    $ExadSliderWrapper.slick({
		slidesToShow: 1,
		arrows: true,
		autoplay: false,
		dots: true
    });
};
// slider js ends here.