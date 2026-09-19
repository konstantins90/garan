define([
    'uiComponent',
    'jquery',
    'Smetana_Garant/js/garant-html'
], function (Component, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Smetana_Garant/item-label',
            displayArea: 'after_details'
        },

        getHtml: function (quoteItem) {
            var items,
                match;

            if (!window.checkoutConfig || !window.checkoutConfig.quoteItemData) {
                return '';
            }

            items = window.checkoutConfig.quoteItemData;
            match = items.find(function (item) {
                return Number(item.item_id) === Number(quoteItem.item_id);
            });

            return match && match.garant ? match.garant.html : '';
        },

        isVisible: function (quoteItem) {
            return this.getHtml(quoteItem) !== '';
        },

        applyWidgets: function (element) {
            $(element).trigger('contentUpdated');
        }
    });
});
