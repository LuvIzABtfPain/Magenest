<?php

namespace Magenest\Blog\Controller\Blog;
use Magento\Framework\Registry;
use Magento\Framework\Controller\Result\JsonFactory;

class Detail extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $resultJsonFactory;

    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Registry $coreRegistry,
        JsonFactory $resultJsonFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = (int) $this->getRequest()->getParam('id');
        if ($this->_coreRegistry->registry('blogId')) {
            $this->_coreRegistry->unregister('blogId');
        }
        // set value to _coreRegistry variable  blog_id
        $this->_coreRegistry->register('blogId', $blogId);
        $resultPage = $this->resultPageFactory->create();
        $result = $this->resultJsonFactory->create();
        $block = $resultPage->getLayout()
            ->createBlock('Magenest\Blog\Block\BlogDetail')
            ->setTemplate('Magenest_Blog::blog_detail.phtml')
            ->toHtml();
        $result->setData(['output' => $block]);
        return $resultPage;

    }
}
