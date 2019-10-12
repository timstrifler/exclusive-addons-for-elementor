
var ModalPopup = function ($scope, $) {
    // var $modalWrapper = $scope.find('.exad-modal-trigger').eq(0);
        //$modalAction = $modalWrapper.find('.exad-modal-image-action');
    
    // $modalWrapper.magnificPopup({
    //     removalDelay: 300,
    //     mainClass: 'mfp-fade'
    // });

    // $(".exad-modal-image-action").on("click", function (e) {
    //     e.preventDefault();
    //     var modal = $(this).data("modal");
    //     $(modal).addClass('active');
    //     $('.overlay').addClass('active');
    // });

    // $('.close-btn').click(function () {
    //     $('.overlay').removeClass('active');
    //     $('.exad-modal-item').removeClass('active');
    // });
    // $('.overlay').click(function () {
    //     $('.overlay').removeClass('active');
    //     $('.exad-modal-item').removeClass('active');
    // });

    var $modalWrapper = $scope.find('.exad-modal').eq(0),
            $modalAction = $modalWrapper.find('.exad-modal-image-action'),
            $closeButton = $modalWrapper.find('.exad-close-btn');
            // $closeIframe = $modalWrapper.find('iframe');

		$modalAction.on("click", function(e) {
			e.preventDefault();
			var $modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data("exad-modal");
            // var $videoSrc = $(this).find('src');

            // console.log($videoSrc);
			
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
            // $('.exad-modal-item .exad-modal-content .exad-modal-element iframe').css('display', 'none');
            $modalOverlay.removeClass('active');
            $modalItem.removeClass('active');
            setTimeout(() => {
                $('.exad-modal-item').css('display', 'none');
            }, 3500);
        });

        $('.exad-modal-overlay').click(function(){
            var $overlay_click_close = $modalAction.data("exad_overlay_click_close");
            console.log($overlay_click_close);
            if( $overlay_click_close == "yes" ){
                $(this).removeClass('active');
                $('.exad-modal-item').removeClass('active');
            }
        });


        // $closeButton.on('hide.bs.modal', function (e) {
        //     // a poor man's stop video
        //     $("#vimeo-video").attr('src',$videoSrc);
        // })
        
    //     function stopVid(){
    //         video.pause();
    //         video.currentTime = 0;
    //    }

};