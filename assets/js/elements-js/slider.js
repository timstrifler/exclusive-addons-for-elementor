// slider js starts here. 
var ExadSlider = function($scope, $) {
    var ExadSliderControls = $scope.find('.exad-slider').eq(0),
    sliderNav              = ExadSliderControls.data('slider-nav'),
    autoPlay               = (ExadSliderControls.data('autoplay') !== undefined) ? ExadSliderControls.data('autoplay') : false,
    pauseOnHover           = (ExadSliderControls.data('pauseonhover') !== undefined) ? ExadSliderControls.data('pauseonhover') : false,
    enableFade             = (ExadSliderControls.data('enable-fade') !== undefined) ? ExadSliderControls.data('enable-fade') : false,
    vertically             = (ExadSliderControls.data('slide-vertically') !== undefined) ? ExadSliderControls.data('slide-vertically') : false,
    centermode             = (ExadSliderControls.data('centermode') !== undefined) ? ExadSliderControls.data('centermode') : false,
    loop                   = (ExadSliderControls.data('loop') !== undefined) ? ExadSliderControls.data('loop') : false,
    autoplaySpeed          = (ExadSliderControls.data('autoplayspeed') !== undefined) ? ExadSliderControls.data('autoplayspeed') : '',
    dotsType               = (ExadSliderControls.data('dots-type') !== undefined) ? ExadSliderControls.data('dots-type') : '',
    centerModePadding      = (ExadSliderControls.data('centermode-padding') !== undefined) ? ExadSliderControls.data('centermode-padding') : '',
    transitionSpeed        = ExadSliderControls.data('slider-speed');
    
    if ( 'both' == sliderNav ) {
        var arrows = true;
        var dots = true;
    } else if ( 'arrows' == sliderNav ) {
        var arrows = true;
        var dots = false;
    } else if ( 'dots' == sliderNav ) {
        var arrows = false;
        var dots = true;
    } else {
        var arrows = false;
        var dots = false;
    }

    if( true == vertically ){
    	var verticalSwipe = true;
    } else {
    	var verticalSwipe = false;
    }

    ExadSliderControls.slick({
        slidesToShow: 1,
        arrows: arrows,
        dots: dots,
        autoplay: autoPlay,
        fade: enableFade,
        centerMode: centermode,
  		centerPadding: centerModePadding,
        vertical: vertically,
        verticalSwiping: verticalSwipe,
        pauseOnHover: pauseOnHover,
        infinite: loop,
        autoplaySpeed: autoplaySpeed,
        speed: transitionSpeed,
        customPaging: function (slider, i) {
            if( dotsType == 'dot-image' ){
                var image = $(slider.$slides[i]).data('image');
                return '<a><img src="' + image + '"></a>';
            }
            return;
        }
    });
};
// slider js ends here.