<?php

namespace Magenest\Knockout\Block\Cart\Additional;

use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;

class Info extends \Magento\Checkout\Block\Cart\Additional\Info
{
    protected $_item;
    public function getSendDay(){
        $data = $this->_item->getBuyRequest()->getData();
        if(isset($data['send_day'])) {
            return $data['send_day'];
        } else return '0';
    }
}
