<?php

namespace Magenest\Movie\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Theme\Block\Html\Breadcrumbs;

class Modal extends Action
{
    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        // Tạo tiêu đề
        $resultPage->getConfig()->getTitle()->set(__('Modal Test'));

        // Tạo breadcrumb
        /** @var Breadcrumbs */
        return $resultPage;
    }
}
