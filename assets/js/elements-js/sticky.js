
// Sticky script starts
var exclusiveSticky = function ($scope, $) {
	var exadStickySection = $scope.find('.exad-sticky-section-yes').eq(0);

	exadStickySection.each(function(i) {
		var dataSettings = $(this).data('settings');
		$.each( dataSettings, function(index, value) { 
			if( index === 'exad_sticky_top_spacing' ){
				$scope.find('.exad-sticky-section-yes').css( "top", value + "px" );
			}
		}); 
    });
	$scope.each(function(i) {
		var sectionSettings = $scope.data("settings");
		$.each( sectionSettings, function(index, value) { 
			if( index === 'exad_sticky_top_spacing' ){
				$scope.css( "top", value + "px" );
			}
		}); 
    });
    
	if ( exadStickySection.length > 0 ) {
		var parent = document.querySelector('.exad-sticky-section-yes').parentElement;
		while (parent) {
			var hasOverflow = getComputedStyle(parent).overflow;
			if (hasOverflow !== 'visible') {
				parent.style.overflow = "visible"
			}
			parent = parent.parentElement;
		}
	}

	var columnClass = $scope.find( '.exad-column-sticky' );
	var dataId = columnClass.data('id');
	var dataType = columnClass.data('type');
	var topSpacing = columnClass.data('top_spacing');

	if( dataType === 'column' ){
		var $target  = $scope;
		var wrapClass = columnClass.find( '.elementor-widget-wrap' );
	
		wrapClass.stickySidebar({
			topSpacing: topSpacing,
			bottomSpacing: 60,
			containerSelector: '.elementor-row',
        	innerWrapperSelector: '.elementor-column-wrap',
		});
	}

}
// Sticky script ends
