// modal popup script starts

var exclusiveModalPopup = function ($scope, $) {

    var modalWrapper    = $scope.find( '.exad-modal' ).eq(0),
    modalOverlayWrapper = $scope.find( '.exad-modal-overlay' ),
    modalItem           = $scope.find( '.exad-modal-item' ),
    modalAction         = modalWrapper.find( '.exad-modal-image-action' ),
    closeButton         = modalWrapper.find( '.exad-close-btn' );

    modalAction.on( 'click', function(e) {
        e.preventDefault();
        var modalOverlay = $(this).parents().eq(1).next();
        var modal         = $(this).data( 'exad-modal' );
        
        var overlay = $(this).data( 'exad-overlay' );
        modalItem.css( 'display', 'block' );
        setTimeout( function() {
            $(modal).addClass( 'active' );
        }, 100);
        if ( 'yes' === overlay ) {
            modalOverlay.addClass( 'active' );
        }
        
    } );

    closeButton.click( function() {
        var modalOverlay = $(this).parents().eq(3).next();
        var modalItem    = $(this).parents().eq(2);
        modalOverlay.removeClass( 'active' );
        modalItem.removeClass( 'active' );

        var modal_iframe = modalWrapper.find( 'iframe' ),
        $modal_video_tag  = modalWrapper.find( 'video' );

        if ( modal_iframe.length ) {
            var modal_src = modal_iframe.attr( 'src' ).replace( '&autoplay=1', '' );
            modal_iframe.attr( 'src', '' );
            modal_iframe.attr( 'src', modal_src );
        }
        if ( $modal_video_tag.length ) {
            $modal_video_tag[0].pause();
            $modal_video_tag[0].currentTime = 0;
        }
        
    } );

    modalOverlayWrapper.click( function() {
        var overlay_click_close = $(this).data( 'exad_overlay_click_close' );
        if( 'yes' === overlay_click_close ){
            $(this).removeClass( 'active' );
            $( '.exad-modal-item' ).removeClass( 'active' );

            var modal_iframe = modalWrapper.find( 'iframe' ),
            $modal_video_tag = modalWrapper.find( 'video' );

            if ( modal_iframe.length ) {
                var modal_src = modal_iframe.attr( 'src' ).replace( '&autoplay=1', '' );
                modal_iframe.attr( 'src', '' );
                modal_iframe.attr( 'src', modal_src );
            }
            if ( $modal_video_tag.length ) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }
        }
    } );
}

// modal popup script ends
