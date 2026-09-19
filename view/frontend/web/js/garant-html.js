define([
    'ko',
    'jquery'
], function (ko, $) {
    'use strict';

    ko.bindingHandlers.garantHtml = {
        update: function (element, valueAccessor) {
            var html = ko.unwrap(valueAccessor()) || '';

            element.innerHTML = html;
            $(element).trigger('contentUpdated');
        }
    };

    return ko.bindingHandlers.garantHtml;
});
