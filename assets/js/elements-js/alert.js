//alert script starts

var exclusiveAlert = function( $scope, $ ) {
    var alertClose = $scope.find( '[data-alert]' ).eq(0);
    alertClose.each( function(index){
        var alert = $(this);
        alert.find( '.exad-alert-element-dismiss-icon' ).click(function(e){
            e.preventDefault();
            alert.fadeOut(500);
        });
        alert.find( '.exad-alert-element-dismiss-button' ).click(function(e){
            e.preventDefault();
            alert.fadeOut(500);
        });
    });
}

//alert script ends
