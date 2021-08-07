(function ($) {
    $( document ).ready(function () {

        if ( window.elementor ) {
            // Add item to contextMenu on Elementor load
            elementor.hooks.addFilter( 'element/view', function( groups_prototype, element ) {

                if ( element.get('elType') === 'column' ) {
                    return groups_prototype.extend( {
                        getContextMenuGroups: function () {
                            return groups_prototype.prototype.getContextMenuGroups.apply(this, arguments);
                        }
                    } )
                }

                return groups_prototype;
            } );

            // Add item to contextMenu on new column
            elementor.hooks.addFilter( 'elements/column/contextMenuGroups', addItemToContextMenu )
        }

    });

    /**
     * Adds new item to context menu
     * */
    function addItemToContextMenu( groups, element ) {

        // Find index of Elementor default clipboard
        var clipboard_index = groups.findIndex( function ( item ) {
            return 'addNew' === item.name;
        } );

        // Push new context item inside clipboard
        groups[clipboard_index].actions.push( {
            name: 'exad-add-child-section',
            title: 'Add Child Section',
            icon: 'context-menu-icon exad exad-logo',
            callback: function() {
                insertNestedSection( element );
            },
            isEnabled: function() {
                return true;
            }
        } );

        return groups

    }

    /**
     * Inserts new inner section inside parent column or section
     * */
    function insertNestedSection( element ) {

        var element_view = element.getContainer().view;

        if ( element_view.getElementType() === 'column' ) {
            // Insert new inner section
            element_view.addElement( {
                elType: 'section',
                isInner: true,
                settings: {},
                elements: [{
                    id: elementor.helpers.getUniqueID(),
                    elType: 'column',
                    isInner: true,
                    settings: {
                        _column_size: 100
                    },
                    elements: []
                }]
            } );
        }

    }

})(jQuery);
