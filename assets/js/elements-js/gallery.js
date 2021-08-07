
// filterable gallery script starts

var exclusiveFilterableGallery = function( $scope, $ ) {
    $( window ).load( function() {

        if ( $.isFunction( $.fn.isotope ) ) {
            var exadGetGallery       = $scope.find( '.exad-gallery-element' ).eq( 0 ),
            currentGalleryId         = '#' + exadGetGallery.attr( 'id' ),
            $container             = $scope.find( currentGalleryId ).eq( 0 );
            
            var galleryMainWrapper = $scope.find( '.exad-gallery-items' ).eq( 0 ),
            galleryItem            = '#' + galleryMainWrapper.attr( 'id' );

            $container.isotope({
                filter: '*',
                animationOptions: {
                    queue: true
                }
            });

            $( galleryItem + ' .exad-gallery-menu button' ).click( function() {
                $( galleryItem + ' .exad-gallery-menu button.current' ).removeClass( 'current' );
                $( this ).addClass( 'current' );
         
                var selector = $( this ).attr( 'data-filter' );
                $container.isotope( {
                    filter: selector,
                    layoutMode: 'fitRows',
                    getSortData: {
                        name: '.name',
                        symbol: '.symbol',
                        number: '.number parseInt',
                        category: '[data-category]',
                        weight: function( itemElem ) {
                            var weight = $( itemElem ).find( '.weight' ).text();
                            return parseFloat( weight.replace( /[\(\)]/g, '' ) );
                        }
                    },
                    animationOptions: {
                        queue: true
                    }
                 } );
                 return false;
            } ); 
        }
    } ); 
}

// filterable gallery script ends
