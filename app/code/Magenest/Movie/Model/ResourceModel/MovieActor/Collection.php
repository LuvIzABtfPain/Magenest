<?php

namespace Magenest\Movie\Model\ResourceModel\MovieActor;

use Magenest\Movie\Model\ResourceModel\MovieActor;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(\Magenest\Movie\Model\MovieActor::class, MovieActor::class);
    }
}
