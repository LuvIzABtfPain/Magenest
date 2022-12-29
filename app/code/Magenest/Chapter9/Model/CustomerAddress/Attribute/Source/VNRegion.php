<?php

namespace Magenest\Movie\Model\CustomerAddress\Attribute\Source;


class VNRegion extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    public function getAllOptions()
    {
        return [
            'value' => ''
        ];
    }
}
