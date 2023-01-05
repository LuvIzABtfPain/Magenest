<?php

namespace Magenest\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class BlogList extends Template
{
    protected $blogsFactory;

    public function __construct(
        Template\Context  $context,
        CollectionFactory $blogsFactory,
    )
    {
        $this->blogsFactory = $blogsFactory;
        parent::__construct($context);
    }
    public function getBlog(){
        $blogs = $this->blogsFactory->create();
        return $blogs;
    }
}
