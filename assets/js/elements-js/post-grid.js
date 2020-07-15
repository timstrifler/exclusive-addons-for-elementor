// Post grid script starts

var exclusivePostGrid = function( $scope, $ ) {
    var exadPostgridWrapped = $scope.find( '.exad-post-grid' );

    var exadPostArticle = exadPostgridWrapped.find('.exad-post-grid-three .exad-post-grid-container.exad-post-grid-equal-height-yes');

    // Match Height
    exadPostArticle.matchHeight({
        byRow: 0
    });

    var btn = exadPostgridWrapped.find('.paginate-btn');

    var posts_per_page = 6;
    var page = 1;

    $(btn).on("click", function(e){
        e.preventDefault();
        $.ajax({
			url: exad_ajax_object.ajax_url,
			type: 'POST',
			data: {
				action: 'ajax_pagination',
                page : page,
			},
            success: function( html ) {
                // $('#info').empty();
                $('.exad-row-wrapper').append( html );
                page++;
                console.log(html);
            },
            // beforeSend: function(){
            //     // $('.exad-row-wrapper').empty();
            //     $('.exad-row-wrapper').append( "Loding..." );
            // }
		})
    });
          
}

// post grid script ends
