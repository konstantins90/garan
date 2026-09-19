define([
    'uiComponent',
    'jquery',
    'Smetana_Garant/js/garant-html'
], function (Component, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Smetana_Garant/notice'
        },

        /**
         * The line item decides: product switch and the rule that a guarantee
         * replaces the notice are evaluated server side.
         */
        isVisible: function (quoteItem) {
            var items,
                match;

            if (!this.getHtml() || !window.checkoutConfig.quoteItemData) {
                return false;
            }

            items = window.checkoutConfig.quoteItemData;
            match = items.find(function (item) {
                return Number(item.item_id) === Number(quoteItem.item_id);
            });

            return !!(match && match.garant_notice);
        },

        getHtml: function () {
            var notice = window.checkoutConfig
                && window.checkoutConfig.smetanaGarant
                && window.checkoutConfig.smetanaGarant.notice;

            return notice && notice.enabled && notice.html ? notice.html : '';
        },

        applyWidgets: function (element) {
            $(element).trigger('contentUpdated');
        }
    });
});
