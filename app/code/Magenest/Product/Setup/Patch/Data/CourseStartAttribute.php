<?php

namespace Magenest\Product\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CourseStartAttribute implements DataPatchInterface
{
    private $eavSetupFactory;
    private $moduleDataSetup;

    public function __construct(
        EavSetupFactory          $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function apply()
    {

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributeCode = 'course_start';

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            $attributeCode,
            [
                'type' => 'datetime',
                'label' => 'Course Start Date',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 200,
                'system' => false,
                'group' => 'Course Start',
                'apply_to' => 'virtual',
                'is_filterable_in_grid' => 1,
                'is_used_in_grid' => 1,
                'is_visible_in_grid' => 1,
            ]
        );


    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

}
