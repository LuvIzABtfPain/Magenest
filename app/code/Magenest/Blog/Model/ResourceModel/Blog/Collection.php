<?php

namespace Magenest\Blog\Model\ResourceModel\Blog;

use Magenest\Blog\Model\ResourceModel\Blog;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init(\Magenest\Blog\Model\Blog::class, Blog::class);
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        return $this->getSelect()->join(
            ['author' => $this->getTable('admin_user')],
            'main_table.author_id = author.user_id',
        );
    }


}
