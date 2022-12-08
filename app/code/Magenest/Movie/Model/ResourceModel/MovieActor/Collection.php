<?php

namespace Magenest\Movie\Model\ResourceModel\Movie_Actor;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magenest\Movie\Model\ResourceModel\Movie_Actor;

class Collection extends AbstractDb
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(\Magenest\Movie\Model\Movie_Actor::class, Movie_Actor::class);
    }
    public function insertMovieActor($id, array $actor){

    }
}
