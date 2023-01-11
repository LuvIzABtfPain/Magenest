<?php

namespace Magenest\Knockout\Block\Cart\Additional;

class InfoSaleOrder extends \Magento\Framework\View\Element\Template
{
    public function getSendDay(){
        $data = $this->getItem();
        if(isset($data['product_options']['info_buyRequest']["send_day"]))
        return $data['product_options']['info_buyRequest']["send_day"];
        else return "Today";
    }
}
