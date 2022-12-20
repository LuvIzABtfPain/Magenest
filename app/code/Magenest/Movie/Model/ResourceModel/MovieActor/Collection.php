<?php

namespace Magenest\Movie\Model\ResourceModel\MovieActor;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magenest\Movie\Model\ResourceModel\MovieActor;

class Collection extends AbstractDb
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(\Magenest\Movie\Model\MovieActor::class, MovieActor::class);
    }
    public function insertMovieActor($id, array $actor){

    }
}
