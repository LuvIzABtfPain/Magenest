<?php
namespace Magenest\Movie\Model;
use Magento\Framework\Model\AbstractModel;

class Movie extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\ResourceModel\Movie');
    }
    public function resetRating(){
        return $this->setData('rating', 0);
    }
}
