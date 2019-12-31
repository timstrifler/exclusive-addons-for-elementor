// Filterable gallery
var exclusiveFilterableGallery = function( $scope, $ ) {

    if ( $.isFunction($.fn.isotope) ) {
        var $galleryWrapper = $scope.find('#exad-gallery-one').eq(0),
        $galleryElement     = $galleryWrapper.find('.exad-gallery-element'),
        $galleryFilter      = $galleryWrapper.find('#filters'),
        $galleryMenu        = $galleryWrapper.find('.exad-gallery-menu');

        // filter functions
        var filterFns = {
            // show if number is greater than 50
            numberGreaterThan50: function() {
                var number = $(this).find('.number').text();
                return parseInt( number, 10 ) > 50;
            },
            // show if name ends with -ium
            ium: function() {
                var name = $(this).find('.name').text();
                return name.match( /ium$/ );
            }
        };    

        var $gallery = $galleryElement.isotope({
            itemSelector: '#exad-gallery-one .exad-gallery-item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.name',
                symbol: '.symbol',
                number: '.number parseInt',
                category: '[data-category]',
                weight: function( itemElem ) {
                    var weight = $( itemElem ).find('.weight').text();
                    return parseFloat( weight.replace( /[\(\)]/g, '') );
                }
            }
        });

        // bind filter button click
        $galleryFilter.on( 'click', 'button', function() {
            var filterValue = $( this ).attr('data-filter');
            // use filterFn if matches value
            filterValue = filterFns[ filterValue ] || filterValue;
            $gallery.isotope({ filter: filterValue });
        });

        // change is-checked class on buttons
        $galleryMenu.each( function( i, buttonGroup ) {
            var $buttonGroup = $( buttonGroup );
            $buttonGroup.on( 'click', 'button', function() {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                $( this ).addClass('is-checked');
            });
        });
    }
}

