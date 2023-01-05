<?php

namespace Magenest\Blog\Block\Adminhtml\Blog\Edit;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    protected $blogFactory;

    public function __construct(
        Context                 $context,
        \Magenest\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->context = $context;
        $this->blogFactory = $blogFactory;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getBlogId()
    {

        $id = $this->context->getRequest()->getParam('id');
        $blog = $this->blogFactory->create()->load($id);
        if ($blog->getId())
            return $id;
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
