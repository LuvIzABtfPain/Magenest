<?php

namespace Magenest\Blog\Model;

use Magenest\Blog\Api\BlogRepositoryInterface;
use Magenest\Blog\Api\Data\BlogInterface;
use Magenest\Blog\Api\Data\BlogSearchResultInterfaceFactory;
use Magenest\Blog\Model\ResourceModel\Blog;
use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Route\Config;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\Framework\App\ResourceConnection;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * @var BlogFactory
     */
    protected $blogFactory;
    protected $_resource;
    protected $resourceModel;
    /**
     * @var BlogCollectionFactory
     */
    protected $blogCollectionFactory;
    /**
     * @var BlogSearchResultInterfaceFactory
     */
    protected $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;
    /**
     * @var \Magento\UrlRewrite\Model\UrlRewriteFactory
     */
    protected $_urlRewriteFactory;
    private $routeConfig;

    public function __construct(
        Blog                             $resourceModel,
        BlogFactory                      $blogFactory,
        BlogCollectionFactory            $blogCollectionFactory,
        BlogSearchResultInterfaceFactory $blogSearchResultInterfaceFactory,
        CollectionProcessorInterface     $collectionProcessor,
        UrlRewriteFactory                $urlRewriteFactory,
        ResourceConnection $resource,
        ?Config                          $routeConfig = null
    )
    {
        $this->blogFactory = $blogFactory;
        $this->resourceModel = $resourceModel;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->searchResultFactory = $blogSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->_urlRewriteFactory = $urlRewriteFactory;
        $this->_resource = $resource;
        $this->routeConfig = $routeConfig ?? ObjectManager::getInstance()->get(Config::class);
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    public function delete(BlogInterface $blog)
    {
        $this->resourceModel->delete($blog);
        return true;
    }

    public function getById($id)
    {
        $blog = $this->blogFactory->create();
        $blog->load($id);
        if (!$blog->getId()) {
            throw new NoSuchEntityException(__('Unable to find blog with ID "%1"', $id));
        }
        return $blog;
    }

    public function save(BlogInterface $blog)
    {
        try {
            $this->validateUrlDuplication($blog);
            $this->resourceModel->save($blog);
        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(
                __('Could not save the blog: %1', $exception->getMessage()),
                $exception
            );
        }
        $this->applyUrlRewrite($blog);
        return $blog;
    }

    private function validateUrlDuplication($blog): void
    {
        if ($this->checkUrlInTable($blog)) {
            throw new CouldNotSaveException(
                __('The value specified in the URL Key field would generate a URL that already exists.')
            );
        }
    }

    private function applyUrlRewrite($blog): void
    {
        $urlRewriteModel = $this->_urlRewriteFactory->create();
        /* set current store id */
        $urlRewriteModel->setStoreId(1);
        /* this url is not created by system so set as 0 */
        $urlRewriteModel->setIsSystem(0);
        /* unique identifier - set random unique value to id path */
        $urlRewriteModel->setIdPath(rand(1, 100000));
        /* set actual url path to target path field */
        $urlRewriteModel->setTargetPath("blog/blog/detail/id/".$blog->getId());
        /* set requested path which you want to create */
        $urlRewriteModel->setRequestPath($blog->getUrl().'.html');
        /* set current store id */
        $urlRewriteModel->save();
    }
    private function checkUrlInTable($blog) {
        $urlPath = $blog->getUrl().'.html';
        $connection  = $this->_resource->getConnection();
        $query = $connection->select()->from('url_rewrite')->where("request_path = '$urlPath'");
        $res = $connection->query($query)->rowCount();
        if($res == 0)
            return false;
        else return true;
    }
}
