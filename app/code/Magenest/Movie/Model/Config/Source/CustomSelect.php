<?php

namespace Magenest\Movie\Model\Config\Source;

class CustomSelect implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('show')],
            ['value' => 2, 'label' => __('not-show')],
        ];
    }
}
