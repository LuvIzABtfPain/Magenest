<?php

namespace Magenest\Blog\Block;

use Magenest\Blog\Model\BlogFactory;
use Magenest\Blog\Model\ResourceModel\Blog;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;


class BlogDetail extends Template
{
    protected $blogFactory;
    protected $resourceModel;

    public function __construct(
        Template\Context $context,
        BlogFactory             $blogFactory,
        Blog $resourceModel,
        Registry         $coreRegistry
    )
    {
        $this->blogFactory = $blogFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->resourceModel = $resourceModel;
        parent::__construct($context);
    }

    public function getBlog()
    {
        $blogId = '';
        if ($this->_coreRegistry->registry('blogId')) {
            $blogId = $this->_coreRegistry->registry('blogId');
        }
        $blog = $this->blogFactory->create();
        $this->resourceModel->load($blog, $blogId);
        return $blog;
    }
}
