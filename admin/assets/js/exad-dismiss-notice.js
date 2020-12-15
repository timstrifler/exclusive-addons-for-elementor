jQuery(document).ready(function ($) {
    

    $( 'div[data-dismissible] button.notice-dismiss' ).click(
        function (event) {
            event.preventDefault();
            var $this = $( this );

            var attr_value, option_name, dismissible_length, data;

            attr_value = $this.parent().attr( 'data-dismissible' ).split( '-' );

            dismissible_length = attr_value.pop();

            option_name = attr_value.join( '-' );

            data = {
                'action': 'dismiss_admin_notice',
                'option_name': option_name,
                'dismissible_length': dismissible_length,
                'nonce': dismissible_notice.nonce
            };

            $.post( 'https://devscred.local/wp-admin/admin-ajax.php', data );
        }
    );
}(jQuery));