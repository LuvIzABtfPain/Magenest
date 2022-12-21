<?php

namespace Magenest\Movie\Model\ResourceModel\Movie;

use Magenest\Movie\Model\ResourceModel\Movie;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'movie_id';

    public function joinTable()
    {
        $directorTable = $this->getTable('magenest_director');
        $result = $this->join($directorTable,
            'main_table.director_id=' . $directorTable . '.director_id', ['director' => 'name']);
        return $result;
    }

    protected function _construct()
    {
        $this->_init(\Magenest\Movie\Model\Movie::class, Movie::class);
    }
}
