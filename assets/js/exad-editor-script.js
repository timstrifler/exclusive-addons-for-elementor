(function($, elementor) {
    'use strict';

    elementor.on('panel:init', function() {
        $('#elementor-panel-elements-search-input').on('keyup', _.debounce(function() {
            $('#elementor-panel-elements').find('.exad-element-icon').parents('.elementor-element').addClass('exad-element-wrapper');
        }, 100));
    });

}(jQuery, elementor));
