define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function ($, modal) {
    'use strict';

    /**
     * Compact mark on a line item that opens the full label in a modal box.
     */
    return function (config, element) {
        var $root = $(element),
            $trigger = $root.find('[data-role="garant-modal-trigger"]'),
            $content = $root.find('[data-role="garant-modal-content"]');

        if (!$content.length || $content.data('garantModal')) {
            return;
        }

        modal({
            type: 'popup',
            modalClass: 'garant-modal',
            title: config.title || '',
            responsive: true,
            innerScroll: true,
            buttons: []
        }, $content);

        // The modal wrapper keeps the content hidden until it is opened.
        $content.data('garantModal', true).removeAttr('hidden');

        $trigger.on('click', function (event) {
            event.preventDefault();
            $content.modal('openModal');
        });
    };
});
