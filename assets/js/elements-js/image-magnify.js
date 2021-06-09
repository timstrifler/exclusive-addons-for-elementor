// image magnifier script starts

var exclusiveImageMagnifier = function($scope, $) {

    var $magnify = $scope.find( '.exad-image-magnify' ).eq(0),
    $large       = $magnify.find( '.exad-magnify-large' ),
    $small       = $magnify.find( '.exad-magnify-small > img' );
    

    var native_width  = 0;
    var native_height = 0;
    $large.css("background","url('" + $small.attr("src") + "') no-repeat");
    
    //Now the mousemove function
    $magnify.mousemove( function(e){
        
        if(!native_width && !native_height) {
            var image_object = new Image();
            image_object.src = $small.attr("src");
            
            native_width = image_object.width;
            native_height = image_object.height;
        } else {
            var magnify_offset = $(this).offset();
            var mx = e.pageX - magnify_offset.left;
            var my = e.pageY - magnify_offset.top;
            
            //Finally the code to fade out the glass if the mouse is outside the container
            if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0){
                $large.fadeIn(100);
            } else {
                $large.fadeOut(100);
            }
            
            if($large.is(":visible")) {
                
                var rx = Math.round(mx/$small.width()*native_width - $large.width()/2)*-1;
                var ry = Math.round(my/$small.height()*native_height - $large.height()/2)*-1;
                var bgp = rx + "px " + ry + "px";
                
                //Time to move the magnifying glass with the mouse
                var px = mx - $large.width()/2;
                var py = my - $large.height()/2;
                
                $large.css({left: px, top: py, backgroundPosition: bgp});
            }
        }
    } )
}

// image magnifier script ends
