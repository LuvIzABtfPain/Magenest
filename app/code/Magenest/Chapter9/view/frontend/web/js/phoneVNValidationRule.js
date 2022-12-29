define([
    'jquery',
    'jquery/ui',
    'jquery/validate',
    'mage/translate'
], function($){
    'use strict';
    return function() {
        $.validator.addMethod(
            'phoneVN',
            function(value, element) {
                return value.length > 9 &&
                    value.match(/^(\(?(0|\+84)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/);
            },
            $.mage.__('Please specify a valid phone number')
        );
    }
});
