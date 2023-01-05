<?php

namespace Magenest\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magenest\Blog\Api\Data\BlogInterface;

class Blog extends AbstractModel implements BlogInterface
{
    protected function _construct()
    {
        $this->_init('Magenest\Blog\Model\ResourceModel\Blog');
    }
    public function getTitle()
    {
        return $this->_getData('title');
    }
    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }
    public function getUrl()
    {
        return $this->_getData('url_rewrite');
    }
    public function setUrl($url)
    {
        return $this->setData('url_rewrite', $url);
    }
    public function getAuthorId()
    {
        return $this->_getData('author_id');
    }
    public function setAuthorId($id)
    {
        return $this->setData('author_id', $id);
    }

}
