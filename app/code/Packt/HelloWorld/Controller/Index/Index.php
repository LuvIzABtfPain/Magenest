<?php
namespace Packt\HelloWorld\Controller\Index;
class Index implements \Magento\Framework\App\ActionInterface
{
    /** @var \Magento\Framework\View\Result\PageFactory
    protected $resultPageFactory;
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
