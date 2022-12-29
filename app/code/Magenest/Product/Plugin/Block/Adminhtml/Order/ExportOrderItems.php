<?php

namespace Magenest\Product\Plugin\Block\Adminhtml\Order;

class ExportOrderItems
{
    public function __construct()
    {
    }

    public function beforeSetLayout(\Magento\Sales\Block\Adminhtml\Order\View $view)
    {
        $message = 'Are you sure you want to do this?';
        $url = $this->getUrl('route_id/path') . $view->getOrderId();


        $view->addButton(
            'order_myaction',
            [
                'label' => __('Export'),
                'onclick' => "confirmSetLocation('{$message}', '{$url}')"
            ]
        );


    }
}
