<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;

class SetRatingZero implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        $event =  $observer->getEvent();
        $model = $event->getData('movie_data');
        return $model->resetRating()->save();
    }
}
