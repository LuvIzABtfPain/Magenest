<?php

namespace Magenest\Chapter9\Model\CustomerAddress\Attribute\Source;


class VNRegion extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        return [
            ['value' => '', 'label' => __('Please select region')],
            ['value' => 1, 'label' => __('Bac')],
            ['value' => 2, 'label' => __('Trung')],
            ['value' => 3, 'label' => __('Nam')],
        ];
    }
}
