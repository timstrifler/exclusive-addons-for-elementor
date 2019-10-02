
var ModalPopup = function ($scope, $) {
    var $modalWrapper = $scope.find('.exad-modal-trigger').eq(0);
        //$modalAction = $modalWrapper.find('.exad-modal-image-action');
    
    $modalWrapper.magnificPopup({
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });

};