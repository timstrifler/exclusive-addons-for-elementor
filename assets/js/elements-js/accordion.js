// accordion script starts

var exclusiveAccordion = function( $scope, $ ) {
    var accordionTitle = $scope.find( '.exad-accordion-title' );

    // Open default actived tab
    accordionTitle.each(function(){
        if($(this).hasClass( 'active-default' ) ){
            $(this).addClass( 'active' );
            $(this).next( '.exad-accordion-content' ).slideDown();
        }
    });
    
    // Remove multiple click event for nested accordion
    accordionTitle.unbind( 'click' );

    //$accordionWrapper.children('.exad-accordion-content').first().show();
    accordionTitle.click(function(e){
        e.preventDefault();
        if ($(this).hasClass( 'active' ) ) {
            $(this).removeClass( 'active' );
            $(this).next().slideUp( 400 );
        } else {
            $(this).parent().parent().find( '.exad-accordion-title' ).removeClass( 'active' );
            $(this).parent().parent().find( '.exad-accordion-content' ).slideUp( 400 );
            $(this).toggleClass( 'active' );
            $(this).next().slideToggle( 400 );
        }	
    } );        
}

// accordion script ends
