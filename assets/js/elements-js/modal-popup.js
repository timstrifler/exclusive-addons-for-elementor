
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

		$modalAction.on("click", function(e) {
			e.preventDefault();
			var $modalOverlay = $(this).parents().eq(1).next();
			var modal = $(this).data("exad-modal");
			
			var $overlay = $(this).data("exad-overlay");
            $('.exad-modal-item').css('display', 'block');
            // setTimeout(() => {
            //     $(modal).addClass('active');
            // }, 100);
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
                setTimeout(() => {
                    $('.exad-modal-item').css('display', 'none');
                }, 3500);
            });

		$('.exad-modal-overlay').click(function(){
			$(this).removeClass('active');
            $('.exad-modal-item').removeClass('active');
		});	

};