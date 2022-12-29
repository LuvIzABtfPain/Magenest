var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information':{
                'Magenest_Chapter9/js/phoneVNtoForm': true
            },
            'mage/validation': {
                'Magenest_Chapter9/js/phoneVNValidationRule': true
            }
        }
    }
}
