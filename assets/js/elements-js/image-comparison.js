// Image Comparison
var exclusiveImageComparison = function($scope, $) {
    var imageComparison  = $scope.find( '.exad-image-comparision-element' ).eq(0),
    exadOrientation      = imageComparison.data( 'exad-oriantation' ),
    exadBeforeLabel      = imageComparison.data( 'exad-before_label' ),
    exadAfterLabel       = imageComparison.data( 'exad-after_label' ),
    exadDefaultOffsetPct = imageComparison.data( 'exad-default_offset_pct' ),
    exadNoOverlay        = imageComparison.data( 'exad-no_overlay' );
        
    if ( $.isFunction($.fn.twentytwenty) ) {    
        imageComparison.twentytwenty({
            orientation: exadOrientation,
            before_label: exadBeforeLabel,
            after_label: exadAfterLabel,
            default_offset_pct: exadDefaultOffsetPct,
            no_overlay: exadNoOverlay
        } );
    }
}