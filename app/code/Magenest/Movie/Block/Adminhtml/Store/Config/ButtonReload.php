<?php

namespace Magenest\Movie\Block\Adminhtml\Store\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class ButtonReload extends Field
{
    protected function _getElementHtml(AbstractElement $element): string
    {
        $html = '<button onclick = "event.preventDefault(); window.location.reload();">Reload</button>';
        return $html;
    }
}

