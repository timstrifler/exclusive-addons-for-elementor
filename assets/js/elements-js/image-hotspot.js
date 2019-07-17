// Image Hotspot
var ImageHotspot = function ($scope, $) {
    var $hotspotWrapper = $scope.find('.exad-hotspot').eq(0),
        $hotspotItem = $hotspotWrapper.find('.exad-hotspot-dot');

    // hostpot script
    $hotspotItem.each( function(){
        var leftPos = $(this).data('left');
        var topPos = $(this).data('top');
        $(this).css({ "left" : leftPos, "top" : topPos });
    });
    
};