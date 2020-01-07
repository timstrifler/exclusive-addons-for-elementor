// exclusive Button script starts

var exclusiveButton = function ( $scope, $ ) {
    // position on hover a button in button style seven
    var mouseHoverEffect8 = $scope.find( '.effect-8.mouse-hover-effect' ).eq(0);

    mouseHoverEffect8.on( 'mouseenter', function (e) {
        var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
        $(this).find( '.effect-8-position' ).css({
            top: relY,
            left: relX
        })
    } );

    mouseHoverEffect8.on( 'mouseout', function (e) {
        var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;
        $(this).find( '.effect-8-position' ).css({
            top: relY,
            left: relX
        } )
    } );
    // position on hover a button in button style seven
}

// exclusive Button script ends
