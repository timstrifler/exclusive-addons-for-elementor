// progress bar script starts

function animatedProgressbar( id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth ){
    var triggerClass = '.exad-progress-bar-' + id;
    if ( 'function' === typeof ldBar ) {
        if( 'line' === type ) {
            new ldBar( triggerClass, {
                'type'              : 'stroke',
                'path'              : 'M0 10L100 10',
                'aspect-ratio'      : 'none',
                'stroke'			: strokeColor,
                'stroke-trail'	    : trailColor,
                'stroke-width'      : strokeWidth,
                'stroke-trail-width': strokeTrailWidth
            } ).set( value );
        }
        if( 'line-bubble' === type ) {
            new ldBar( triggerClass, {
                'type'              : 'stroke',
                'path'              : 'M0 10L100 10',
                'aspect-ratio'      : 'none',
                'stroke'			: strokeColor,
                'stroke-trail'		: trailColor,
                'stroke-width'      : strokeWidth,
                'stroke-trail-width': strokeTrailWidth
            } ).set( value );
            $( $( '.exad-progress-bar-' + id ).find( '.ldBar-label' ) ).animate( {
                left: value + '%'
            }, 1000, 'swing');
        }
        if( 'circle' === type ) {
            new ldBar( triggerClass, {
                'type'				: 'stroke',
                'path'			    : 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                'stroke-dir'		: 'normal',
                'stroke'		    : strokeColor,
                'stroke-trail'	    : trailColor,
                'stroke-width'	    : strokeWidth,
                'stroke-trail-width': strokeTrailWidth
            } ).set( value );
        }
        if( 'fan' === type ) {
            new ldBar( triggerClass, {
                'type': 'stroke',
                'path': 'M10 90A40 40 0 0 1 90 90',
                'stroke': strokeColor,
                'stroke-trail': trailColor,
                'stroke-width': strokeWidth,
                'stroke-trail-width': strokeTrailWidth
            } ).set( value );
        }
    }
}

var exclusiveProgressBar = function ( $scope, $ ){
    var progressBarWrapper = $scope.find( '[data-progress-bar]' ).eq( 0 );
    if ( $.isFunction( $.fn.waypoint ) ) {
        progressBarWrapper.waypoint( function () {
            var element      = $( this.element ),
            id               = element.data( 'id' ),
            type             = element.data( 'type' ),
            value            = element.data( 'progress-bar-value' ),
            strokeWidth      = element.data( 'progress-bar-stroke-width' ),
            strokeTrailWidth = element.data( 'progress-bar-stroke-trail-width' ),
            color            = element.data( 'stroke-color' ),
            trailColor       = element.data( 'stroke-trail-color' );
            animatedProgressbar( id, type, value, color, trailColor, strokeWidth, strokeTrailWidth );
            this.destroy();
        }, {
            offset: 'bottom-in-view'
        } );
    }
}

// progress bar script ends
