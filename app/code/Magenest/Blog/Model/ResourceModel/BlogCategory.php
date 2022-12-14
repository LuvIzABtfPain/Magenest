<?php

namespace Magenest\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BlogCategory extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('magenest_blog_category', 'id');
    }
}
