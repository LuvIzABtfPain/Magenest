<?php

namespace Magenest\Movie\Model\ResourceModel\Director;
use Magenest\Movie\Model\ResourceModel\Director;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'director_id';

    protected function _construct()
    {
        $this->_init(\Magenest\Movie\Model\Director::class, Director::class);
    }
    public function getOptionSelect(){
        return $this->_toOptionArray();
    }
}
