// setTimeout("alert('Boom!');", 5000);
var ModalPopup = function ($scope, $) {
    var $modalWrapper = $scope.find('.exad-modal').eq(0),
        $modalAction = $modalWrapper.find('.exad-modal-image-action');
        //$closeButton = $modalWrapper.find('.exad-close-btn');

    // $modalAction.on("click", function(e) {
    //     e.preventDefault();
    //     var $modalOverlay = $(this).parents().eq(1).next();
    //     var modal = $(this).data("exad-modal");
        
    //     var $overlay = $(this).data("exad-overlay");

    //     $(modal).addClass('active');
    //     if ( $overlay == "yes" ) {
    //         $modalOverlay.addClass('active');
    //     }
        
    // });

    //$modalAction.magnificPopup({type: 'image'});

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

    // $closeButton.click(function() {
    //     var $modalOverlay = $(this).parents().eq(3).next();
    //     var $modalItem = $(this).parents().eq(2);
    //     $modalOverlay.removeClass('active');
    //     $modalItem.removeClass('active');
    // });

    // $('.exad-modal-overlay').click(function(){
    // 	$(this).removeClass('active');
    // 	$('.exad-modal-item').removeClass('active');
    // });	
};