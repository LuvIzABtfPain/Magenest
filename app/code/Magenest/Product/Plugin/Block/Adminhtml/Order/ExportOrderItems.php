<?php

namespace Magenest\Product\Plugin\Block\Adminhtml\Order;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class ExportOrderItems extends \Magento\Backend\Block\Widget\Container
{
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        Context $context, array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    public function beforeSetLayout(\Magento\Sales\Block\Adminhtml\Order\View $view)
    {
        $url = $this->urlBuilder->getUrl('custombe/export/orderitems'
            , ['order_id' => $view->getOrderId()]
        );
        $view->addButton(
            'order_export',
            [
                'label' => __('Export'),
                'onclick' => 'setLocation(\'' . $url . '\')',
            ]
        );

    }

}
