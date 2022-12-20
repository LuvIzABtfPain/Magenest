<?php

namespace Magenest\Movie\Block\Adminhtml\Movie\Edit;
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
    protected $movieFactory;

    public function __construct(
        Context                 $context,
        \Magenest\Movie\Model\MovieFactory $movieFactory
    )
    {
        $this->context = $context;
        $this->movieFactory = $movieFactory;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getMovieId()
    {

        $id = $this->context->getRequest()->getParam('movie_id');
        $movie = $this->movieFactory->create()->load($id);
        if ($movie->getId())
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
