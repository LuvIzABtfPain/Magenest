<?php

namespace Magenest\Movie\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Theme\Block\Html\Breadcrumbs;

class View extends Action
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
        $resultPage->getConfig()->getTitle()->set(__('Danh sách phim'));

        // Tạo breadcrumb
        /** @var Breadcrumbs */
        if ($resultPage->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbs = $resultPage->getLayout()->getBlock('breadcrumbs');
            $breadcrumbs->addCrumb('TrangChu', ['label' => __('Home'), 'title' => __('TrangChu'), 'link' => $this->_url->getUrl('')]);
            $breadcrumbs->addCrumb('Phim', ['label' => __('Movies'), 'title' => __('Phim')]);
        }
        return $resultPage;
    }
}
