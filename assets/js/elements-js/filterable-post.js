
// filterable post script starts

var exclusiveFilterablePost = function( $scope, $ ) {
    $( window ).on('load', function (e) {

        if ( $.isFunction( $.fn.isotope ) ) {
            var exadGetGallery       = $scope.find( '.filterable-post-container' ).eq( 0 ),
            currentFilteredId         = '#' + exadGetGallery.attr( 'id' ),
            $container             = $scope.find( currentFilteredId ).eq( 0 );
            
            var filterableMainWrapper = $scope.find( '.exad-filterable-items' ).eq( 0 ),
            filterableItem            = '#' + filterableMainWrapper.attr( 'id' );

            $container.isotope({
                filter: '*',
                animationOptions: {
                    queue: true
                }
            });

            $( filterableItem + ' .exad-filterable-menu li' ).click( function() {
                $( filterableItem + ' .exad-filterable-menu li.current' ).removeClass( 'current' );
                $( this ).addClass( 'current' );
         
                var selector = $( this ).attr( 'data-filter' );
                $container.isotope( {
                    filter: selector,
                    layoutMode: 'masonry',
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
                    },
                    masonry: {
                        columnWidth: 1
                    }
                 } );
                 return false;
            } ); 

            $container.imagesLoaded().progress( function() {
                $container.isotope('layout');
            });
        }
    } ); 
}

// filterable post script ends
