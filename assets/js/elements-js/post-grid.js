// Post grid script starts

var exclusivePostGrid = function( $scope, $ ) {
    var exadPostgridWrapped = $scope.find( '.exad-post-grid' );

    var exadPostArticle = exadPostgridWrapped.find('.exad-post-grid-three .exad-post-grid-container.exad-post-grid-equal-height-yes');
    var exadPostWrapper = exadPostgridWrapped.find('.exad-row-wrapper');
    // Match Height
    exadPostArticle.matchHeight({
        byRow: 0
    });

    var btn = exadPostgridWrapped.find('.exad-post-grid-paginate-btn');
    var btnText = btn.text();

    var page = 2;

    $(btn).on("click", function(e){
        e.preventDefault();
        $.ajax({
			url: exad_ajax_object.ajax_url,
			type: 'POST',
			data: {
				action: 'ajax_pagination',
                paged : page,
                post_type: $(this).data('post-type'),
                posts_per_page: $(this).data('posts_per_page'),
            	post_offset: $(this).data('post-offset'),
                post_thumbnail: $(this).data('post-thumbnail'),
                post_thumb_size: $(this).data('post-thumb-size'),
                equal_height: $(this).data('equal_height'),
                enable_details_btn: $(this).data('enable_details_btn'),
                details_btn_text: $(this).data('details_btn_text'),
                show_user_avatar: $(this).data('show-user-avatar'),
                show_user_name: $(this).data('show_user_name'),
                post_data_position: $(this).data('post_data_position'),
                show_title: $(this).data('show_title'),
                title_full: $(this).data('title_full'),
                show_read_time: $(this).data('show_read_time'),
                show_comment: $(this).data('show_comment'),
                show_excerpt: $(this).data('show_excerpt'),
                excerpt_length: $(this).data('excerpt_length'),
                show_user_name_tag: $(this).data('show_user_name_tag'),
                user_name_tag: $(this).data('user_name_tag'),
                show_date: $(this).data('show_date'),
                show_date_tag: $(this).data('show_date_tag'),
                date_tag: $(this).data('date_tag'),
                title_length: $(this).data('title_length'),
                image_align: $(this).data('image_align'),
                category_default_position: $(this).data('category_default_position'),
                category_position_over_image: $(this).data('category_position_over_image'),
                show_category: $(this).data('show_category'),
                category: $(this).data('category'),
                tags: $(this).data('tags'),
                offset: $(this).data('offset'),
                exclude_post: $(this).data('exclude_post')
            },
            beforeSend : function ( xhr ) {
				btn.text('Loading...');
			},
            success: function( html ) {
                if( html.length > 0 ){
                    btn.text(btnText);
                    exadPostWrapper.append( html );
                    page++;
                    setTimeout(function(){
                        var newExadPostArticle = exadPostgridWrapped.find('.exad-post-grid-three .exad-post-grid-container.exad-post-grid-equal-height-yes');
                        newExadPostArticle.matchHeight({
                            byRow: 0
                        });
                    }, 10);
                } else {
					btn.remove();
				}
            },
		});
    });

    
          
}

// post grid script ends
