<?php

namespace Magenest\Chapter9\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddRegionIdForCustomerAddress implements DataPatchInterface
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

        $attributeCode = 'vn_region';

        $customerSetup->addAttribute(
            'customer_address',
            $attributeCode,
            [
                'type' => 'int',
                'label' => 'VN Region',
                'input' => 'select',
                'source' => \Magenest\Chapter9\Model\CustomerAddress\Attribute\Source\VNRegion::class,
                'visible' => true,
                'position' => 190,
                'system' => false,
                'backend' => '',
            ]
        );

        // used this attribute in the following forms
        $attribute = $customerSetup->getEavConfig()
            ->getAttribute('customer_address', $attributeCode)
            ->addData([
                'used_in_forms' => [
                    'adminhtml_customer_address',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit',
                    'customer_address_edit',
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
