<?php

namespace Magenest\Product\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class DynamicRows extends AbstractModifier
{
    const FIELD_IS_DELETE = 'is_delete';
    const FIELD_SORT_ORDER_NAME = 'sort_order';
    const FIELD_NAME_SELECT = 'select_field';

    private $locator;
    public function __construct(
        LocatorInterface $locator
    ) {
        $this->locator = $locator;
    }
    public function modifyData(array $data)
    {
        return $data;
    }
    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'custom_fieldset' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Custom Group'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product.custom_fieldset',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ],
                    'children' => [
                        "custom_field" => $this->getSelectTypeGridConfig(10)
                    ],
                ]
            ]
        );
        return $meta;
    }
    protected function getSelectTypeGridConfig($sortOrder) {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel' => __('Add Value'),
                        'componentType' => DynamicRows::NAME,
                        'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows',
                        'additionalClasses' => 'admin__field-wide',
                        'deleteProperty' => static::FIELD_IS_DELETE,
                        'deleteValue' => '1',
                        'renderDefaultRecord' => false,
                        'sortOrder' => $sortOrder,
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'positionProvider' => static::FIELD_SORT_ORDER_NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                            ],
                        ],
                    ],
                    'children' => [
                        static::FIELD_NAME_SELECT => $this->getSelectFieldConfig(1),
                        static::FIELD_IS_DELETE => $this->getIsDeleteFieldConfig(3)
                        //Add as many fields as you want

                    ]
                ]
            ]
        ];
    }
    protected function getSelectFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Options Select'),
                        'componentType' => Field::NAME,
                        'formElement' => Select::NAME,
                        'component' => 'Magento_Catalog/js/custom-options-type',
                        'elementTmpl' => 'ui/grid/filters/elements/ui-select',
                        // 'selectType' => 'optgroup',
                        'dataScope' => static::FIELD_NAME_SELECT,
                        'dataType' => Text::NAME,
                        'sortOrder' => $sortOrder,
                        'options' => $this->_getOptions(),
                        'visible' => true,
                        'disabled' => false,
                    ],
                ],
            ],
        ];
    }
    protected function _getOptions()
    {
        $options = [
            1 => [
                'label' => __('Option 1'),
                'value' => 1
            ],
            2 => [
                'label' => __('Option 2'),
                'value' => 2
            ],
            3 => [
                'label' => __('Option 3'),
                'value' => 3
            ],
        ];

        return $options;
    }
    protected function getIsDeleteFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => ActionDelete::NAME,
                        'fit' => true,
                        'sortOrder' => $sortOrder
                    ],
                ],
            ],
        ];
    }
}
