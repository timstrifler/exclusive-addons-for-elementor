// countdown timer script starts

var exclusiveCountdownTimer = function ( $scope, $ ) {
    var countdownTimerWrapper = $scope.find( '[data-countdown]' ).eq(0);

    if ( 'undefined' !== typeof countdownTimerWrapper && null !== countdownTimerWrapper ) {
        var $this   = countdownTimerWrapper,
        finalDate   = $this.data( 'countdown' ),
        day         = $this.data( 'day' ),
        hours       = $this.data( 'hours' ),
        minutes     = $this.data( 'minutes' ),
        seconds     = $this.data( 'seconds' ),
        expiredText = $this.data( 'expired-text' );

        if ( $.isFunction( $.fn.countdown ) ) {
            $this.countdown( finalDate, function ( event ) {
                $( this ).html( event.strftime(' ' +
                    '<div class="exad-countdown-container"><div class="exad-countdown-timer-wrapper"><span class="exad-countdown-count">%-D </span><span class="exad-countdown-title">' + day + '</span></div></div>' +
                    '<div class="exad-countdown-container"><div class="exad-countdown-timer-wrapper"><span class="exad-countdown-count">%H </span><span class="exad-countdown-title">' + hours + '</span></div></div>' +
                    '<div class="exad-countdown-container"><div class="exad-countdown-timer-wrapper"><span class="exad-countdown-count">%M </span><span class="exad-countdown-title">' + minutes + '</span></div></div>' +
                    '<div class="exad-countdown-container"><div class="exad-countdown-timer-wrapper"><span class="exad-countdown-count">%S </span><span class="exad-countdown-title">' + seconds + '</span></div></div>'));
            } ).on( 'finish.countdown', function (event) {
                $(this).html( '<p class="message">'+ expiredText +'</p>' );
            } );
        }
    }
}

// countdown timer script ends
