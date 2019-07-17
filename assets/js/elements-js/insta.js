//Instagram Gallery
var InstagramGallery = function( $scope, $ ) {
    var $feed = $scope.find('#instafeed').eq(0);
    $feed.each(function(){
        var limit = $(this).data('limit');
        var template = $(this).data('template');
        var token = $(this).data('token');
        var userId = $(this).data('user-id');
        var userFeed = new Instafeed({
            get: 'user',
            userId: userId,
            limit: limit,
            resolution: 'standard_resolution',
            accessToken: token,
            sortBy: 'most-recent',
            template: template,
        });
        userFeed.run();
    });
};