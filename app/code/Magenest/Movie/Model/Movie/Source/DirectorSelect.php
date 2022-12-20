<?php

namespace Magenest\Movie\Model\Movie\Source;
use Magento\Framework\Data\OptionSourceInterface;
use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;
class DirectorSelect implements OptionSourceInterface
{
    protected $directorsFactory;
    public function __construct(
        CollectionFactory $directorsFactory
    ){
        $this->directorsFactory= $directorsFactory;
    }
    public function toOptionArray()
    {
        return $this->directorsFactory->create()->getOptionSelect();
    }
}
