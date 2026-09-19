define([
    'jquery',
    'mage/collapsible'
], function ($) {
    'use strict';

    /**
     * Closes the surrounding panel from inside its content, so the long
     * artwork does not have to be scrolled back up to the tab headline.
     */
    return function (config, element) {
        var $panel = $(element).closest(config.panel || '.garant-panel');

        $(element).on('click', function (event) {
            event.preventDefault();

            if ($panel.data('mageCollapsible')) {
                $panel.collapsible('deactivate');
            }

            if ($panel.length) {
                $panel.get(0).scrollIntoView({block: 'nearest'});
            }
        });
    };
});
