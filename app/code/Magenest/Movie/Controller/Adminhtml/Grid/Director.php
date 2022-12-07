<?php
namespace Magenest\Movie\Controller\Adminhtml\Magenest;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Director extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context,PageFactory $resultPageFactory) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_Movie::grid');
        $resultPage->addBreadcrumb(__('Magenest'), __('Director'));
        $resultPage->getConfig()->getTitle()->prepend(__('Director'));
        return $resultPage;
    }
    /**
     * {@inheritdoc}
     */

}
