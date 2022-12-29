<?php

namespace Magenest\Chapter9\Model\Attribute\Backend;

class PhoneVN extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();
        $_formated = $object->getData($attributeName . '_is_formated');
        if (!$_formated && $object->hasData($attributeName)) {
            try {
                $value = $this->formatPhone($object->getData($attributeName));
            } catch (\Exception $e) {
                throw new \Magento\Framework\Exception\LocalizedException(__('Invalid Phone'));
            }

            if ($value === null) {
                $value = $object->getData($attributeName);
            }

            $object->setData($attributeName, $value);
            $object->setData($attributeName . '_is_formated', true);
        }

        return $this;
    }
    public function formatPhone($phone)
    {
        return $phone ? str_replace("+84", "0", $phone) : null;
    }
}
