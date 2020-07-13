// Post grid script starts

var exclusivePostGrid = function( $scope, $ ) {
    var exadPostgridWrapped = $scope.find( '.exad-row-wrapper' );

    var exadPostArticle = exadPostgridWrapped.find('.exad-post-grid-three .exad-post-grid-container.exad-post-grid-equal-height-yes');

    // Match Height
    exadPostArticle.matchHeight({
        byRow: 0
    });
          
}

// post grid script ends
