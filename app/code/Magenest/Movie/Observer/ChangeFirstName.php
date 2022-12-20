<?php

namespace Magenest\Movie\Observer;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
class ChangeFirstName implements \Magento\Framework\Event\ObserverInterface
{
    protected $repo;
    public function __construct(CustomerRepository $repo){
        $this->repo = $repo;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $test =  $observer->getEvent();
        $customer = $test->getData('customer');
        $customer->setFirstName('Magenest');
        return $this->repo->save($customer);
    }
}
