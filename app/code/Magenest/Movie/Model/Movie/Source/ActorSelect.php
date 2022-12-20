<?php

namespace Magenest\Movie\Model\Movie\Source;
use Magento\Framework\Data\OptionSourceInterface;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory;
class ActorSelect implements OptionSourceInterface
{
    protected $actorsFactory;
    public function __construct(
        CollectionFactory $actorsFactory
    ){
        $this->actorsFactory= $actorsFactory;
    }
    public function toOptionArray()
    {
        return $this->actorsFactory->create()->getOptionSelect();
    }
}
