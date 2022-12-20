<?php

namespace Magenest\Movie\Observer;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\ObjectManager;

class ChangeFirstNameFrontend implements \Magento\Framework\Event\ObserverInterface
{
    protected $customerFactory;
    public function __construct(CustomerFactory $customerFactory = null){
        $this->customerFactory = $customerFactory ?: ObjectManager::getInstance()->get(customerFactory::class);
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $test =  $observer->getEvent();
        $customer = $test->getData('customer_data_object');
        $customer->setFirstName('Magenest');
        $model = $this->customerFactory->create();
        return $model->updateData($customer)->save();
    }
}
