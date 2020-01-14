
// filterable gallery script starts

var exclusiveFilterableGallery = function( $scope, $ ) {
    $(window).load(function(){

        var exadGetTable       = $scope.find( '.exad-gallery-element' ).eq(0),
        currentTableId         = '#' + exadGetTable.attr('id'),
        $container             = $scope.find( currentTableId ).eq(0);
        
        var galleryMainWrapper = $scope.find( '.exad-gallery-items' ).eq(0),
        galleryItem            = '#' + galleryMainWrapper.attr('id');

        $container.isotope({
            filter: '*',
            animationOptions: {
                queue: true
            }
        });

        $( galleryItem + ' .exad-gallery-menu li' ).click(function(){
            $( galleryItem + ' .exad-gallery-menu li.current' ).removeClass('current');
            $(this).addClass('current');
     
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector,
                layoutMode: 'fitRows',
                getSortData: {
                    name: '.name',
                    symbol: '.symbol',
                    number: '.number parseInt',
                    category: '[data-category]',
                    weight: function( itemElem ) {
                        var weight = $( itemElem ).find( '.weight' ).text();
                        return parseFloat( weight.replace( /[\(\)]/g, '') );
                    }
                },
                animationOptions: {
                    queue: true
                }
             });
             return false;
        }); 
    }); 
}

// filterable gallery script ends
