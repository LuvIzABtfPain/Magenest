<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Backend\Block\Template;
//use Magento\Catalog\Ui\DataProvider\Product\ProductCollectionFactory as Pfactory;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Reports\Model\ResourceModel\Customer\CollectionFactory as Cfactory;
use Magento\Reports\Model\ResourceModel\Order\CollectionFactory as Ofactory;
use Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory as Crefactory;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory as Ifactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as Pfactory;

class Others extends Template
{
    protected $customer;
    protected $invoice;
    protected $order;
    protected $product;
    protected $creditmemos;

    public function __construct(Template\Context $context,
                                Cfactory         $customer,
                                Ifactory         $invoice,
                                Ofactory         $order,
                                Pfactory         $product,
                                Crefactory       $creditmemos,
                                array            $data = [],
                                ?JsonHelper      $jsonHelper = null,
                                ?DirectoryHelper $directoryHelper = null)
    {
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
        $this->customer = $customer;
        $this->product = $product;
        $this->order = $order;
        $this->invoice = $invoice;
        $this->creditmemos = $creditmemos;
    }
    public function countCustomer(){
        return $this->customer->create()->getSize();
    }
    public function countProduct(){
        return $this->product->create()->getSize();
    }
    public function countOrder()
    {
        return $this->order->create()->getSize();
    }
    public function countCredit()
    {
        return $this->creditmemos->create()->getSize();
    }
    public function countInvoice()
    {
        return $this->invoice->create()->getSize();
    }
}
