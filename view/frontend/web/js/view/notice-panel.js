define([
    'uiComponent',
    'jquery',
    'Smetana_Garant/js/garant-html'
], function (Component, $) {
    'use strict';

    /**
     * Collapsible notice below the payment methods, same panel as on the product page.
     */
    return Component.extend({
        defaults: {
            template: 'Smetana_Garant/notice-panel'
        },

        isVisible: function () {
            return this.getHtml() !== '';
        },

        getHtml: function () {
            var notice = window.checkoutConfig
                && window.checkoutConfig.smetanaGarant
                && window.checkoutConfig.smetanaGarant.notice;

            return notice && notice.panelHtml ? notice.panelHtml : '';
        },

        applyWidgets: function (element) {
            $(element).trigger('contentUpdated');
        }
    });
});
