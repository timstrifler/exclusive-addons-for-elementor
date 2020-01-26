// tabs script starts

var exclusiveTabs   = function( $scope, $ ) {
    var tabsWrapper = $scope.find( '[data-tabs]' ).eq(0);
    tabsWrapper.each( function() {
        var tab         = $(this),
        isTabActive     = false,
        isContentActive = false;
        tab.find( '[data-tab]' ).each( function (){
            if( $(this).hasClass( 'active' ) ){
                isTabActive = true;
            }
        } );
        tab.find( '.exad-advance-tab-content' ).each( function (){
            if( $(this).hasClass( 'active' ) ){
                isContentActive = true;
            }
        } );
        if( !isContentActive ){
            tab.find( '.exad-advance-tab-content' ).eq(0).addClass( 'active' );
        }
        if( !isTabActive ){
            tab.find( '[data-tab]' ).eq(0).addClass( 'active' );
        }
        tab.find( '[data-tab]' ).click(function() {
            tab.find( '[data-tab]' ).removeClass( 'active' );
            tab.find( '.exad-advance-tab-content' ).removeClass( 'active' );
            $(this).addClass( 'active' );
            tab.find( '.exad-advance-tab-content' ).eq($(this).index()).addClass( 'active' );
        } );
    } );
}

// tabs script ends
