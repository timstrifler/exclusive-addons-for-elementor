(function($, elementor) {
    'use strict';

    elementor.on('panel:init', function() {
        $('#elementor-panel-elements-search-input').on('keyup', function() {
            $('#elementor-panel-elements').find('.exad-element-icon').parents('.elementor-element').addClass('exad-element-wrapper');
        });
    });

}(jQuery, elementor));
