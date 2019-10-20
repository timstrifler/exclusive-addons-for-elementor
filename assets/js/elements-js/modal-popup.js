
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