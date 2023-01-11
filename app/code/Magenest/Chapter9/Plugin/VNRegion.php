<?php

namespace Magenest\Chapter9\Plugin;
use Magenest\Chapter9\Model\CustomerAddress\Attribute\Source\VNRegion as VNRegionOpt;

class VNRegion
{
    protected $options;
    public function __construct(VNRegionOpt $options)
    {
        $this->options = $options->toOptionArray();
    }

    public function afterProcess($subject, $result){
        $customAttributeCode = 'vn_region';
        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [// customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
               ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
            'label' => 'VN Region',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'options' => $this->options,
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'validation' => [
                'required-entry' => false,
            ],
        ];

        $result['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;
        return $result;
    }
}
