/* Facebook Feed */

var exadFacebookFeed = function($scope) {
    var button = $scope.find('.exad-facebook-load-more');
    var facebook_wrap = $scope.find('.exad-facebook-feed-wrapper');
    
    button.on("click", function(e) {
        e.preventDefault();
        var $self = $(this),
            query_settings = $self.data("settings"),
            total = $self.data("total"),
            items = $scope.find('.exad-facebook-feed-item').length;
        $.ajax({
            url: exad_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: "exad_facebook_feed_action",
                security: exad_ajax_object.nonce,
                query_settings: query_settings,
                loaded_item: items,
            },
            success: function(response) {
                if(total > items){
                    $(response).appendTo(facebook_wrap);
                } else {
                    $self.text('All Loaded').addClass('loaded');
                    setTimeout( function(){
                        $self.css({"display": "none"});
                    },3000);
                }
            },
            error: function(error) {}
        });
    });
};