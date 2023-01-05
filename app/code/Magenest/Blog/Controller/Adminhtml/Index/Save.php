<?php

namespace Magenest\Blog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magenest\Blog\Api\Data\BlogInterface;
use Magenest\Blog\Api\BlogRepositoryInterface;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;
use Magenest\Blog\Model\Blog;
use Magenest\Blog\Model\BlogFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;


    private $blogFactory;

    /**
     * @var BlogRepositoryInterface
     */
    private $blogRepository;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     * @param BlogFactory|null $blogFactory
     * @param BlogRepositoryInterface|null $blogRepository
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor,
        BlogFactory $blogFactory = null,
        BlogRepositoryInterface $blogRepository = null
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->blogFactory = $blogFactory ?: ObjectManager::getInstance()->get(BlogFactory::class);
        $this->blogRepository = $blogRepository ?: ObjectManager::getInstance()->get(BlogRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->dataProcessor->filter($data);
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            /** @var Blog $model */
            $model = $this->blogFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->blogRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($data);
            $this->blogRepository->save($model);
            $this->dataPersistor->set('magenest_blog', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
