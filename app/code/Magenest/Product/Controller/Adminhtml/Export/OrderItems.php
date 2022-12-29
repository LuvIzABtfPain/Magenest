<?php

namespace Magenest\Product\Controller\Adminhtml\Export;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class OrderItems extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    protected $_fileFactory;
    protected $directory;
    protected $orderRepository;
    protected $_productRepository;
    public function __construct(
        \Magento\Backend\App\Action\Context              $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem                    $filesystem,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
    )
    {
        $this->_fileFactory = $fileFactory;
        $this->orderRepository = $orderRepository;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        parent::__construct($context);
    }

    public function getProductBySku($sku)
    {
        return $this->_productRepository->get($sku);
    }
    public function execute()
    {
          $id = $this->getRequest()->getParam('order_id');
          $order = $this->orderRepository->get($id);
          $items = $order->getAllVisibleItems();
          $name = date('m_d_Y_H_i_s');

          $filepath = 'export/custom' . $name . '.csv';
        $this->directory->create('export');
        /* Open file */
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();
        $columns = $this->getColumnHeader();
        foreach ($columns as $column) {
            $header[] = $column;
        }
        /* Write Header */
        $stream->writeCsv($header);

        foreach ($items as $item) {
            $itemData = [];
            $itemData[] = $item->getName();
            $itemData[] = $item->getQtyToShip();
            $itemData[] = $item->getQtyToInvoice();
            $itemData[] = $item->getQtyToRefund();
            $itemData[] = $item->getStatus();
            $itemData[] = $item->getPrice();
            $itemData[] = $item->getDiscountPercent();
            $itemData[] = $item->getRowTotal();
            $stream->writeCsv($itemData);
        }

        $content = [];
        $content['type'] = 'filename'; // must keep filename
        $content['value'] = $filepath;
        $content['rm'] = '1'; //remove csv from var folder

        $csvfilename = 'OrderItem.csv';
        return $this->_fileFactory->create($csvfilename, $content, DirectoryList::VAR_DIR);

    }

    /* Header Columns */
    public function getColumnHeader()
    {
        $headers = ['SKU', 'Product name', 'QtyShip', 'QtyInvoice', 'QtyRefund', 'Status', 'Price', 'Dis Count Percent', 'Row Total'];
        return $headers;
    }
}
