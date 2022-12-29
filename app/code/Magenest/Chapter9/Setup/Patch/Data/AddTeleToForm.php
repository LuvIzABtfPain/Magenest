<?php

namespace Magenest\Chapter9\Setup\Patch\Data;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddTeleToForm implements DataPatchInterface
{
    private $eavSetupFactory;
    private $customerSetupFactory;
    private $moduleDataSetup;

    public function __construct(
        EavSetupFactory          $eavSetupFactory,
        CustomerSetupFactory     $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function apply()
    {

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributeCode = 'tele';

        $customerSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeCode,
            [
                'type' => 'text',
                'label' => 'Telephone Number',
                'input' => 'text',
                'source' => '',
                'visible' => true,
                'position' => 210,
                'system' => false,
                'backend' => '',
            ]
        );

        // used this attribute in the following forms
        $attribute = $customerSetup->getEavConfig()
            ->getAttribute(\Magento\Customer\Model\Customer::ENTITY, $attributeCode)
            ->addData([
                'used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]
            ]);

        $attribute->save();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

}
