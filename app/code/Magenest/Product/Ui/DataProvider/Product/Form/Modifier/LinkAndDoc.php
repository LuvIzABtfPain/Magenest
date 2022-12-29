<?php

namespace Magenest\Product\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Form\Element\ActionDelete;
use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Hidden;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Fieldset;


class LinkAndDoc extends AbstractModifier
{
    const FIELD_IS_DELETE = 'is_delete';
    const FIELD_SORT_ORDER_NAME = 'sort_order';
    const FIELD_NAME_SELECT = 'course_start';
    const GRID_LINK_NAME = 'link-grid';
    const GRID_DOC_NAME = 'doc-grid';
    protected $urlBuilder;

    public const GROUP_CUSTOM_OPTIONS_NAME = 'link-and-doc';
    private $locator;
    protected $meta = [];
    public function __construct(
        LocatorInterface $locator,
        UrlInterface $urlBuilder,
    )
    {
        $this->locator = $locator;
        $this->urlBuilder = $urlBuilder;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;

        $this->createCustomOptionsPanel();

        return $this->meta;
    }
    protected function createCustomOptionsPanel()
    {
        $this->meta = array_replace_recursive(
            $this->meta,
            [
                static::GROUP_CUSTOM_OPTIONS_NAME => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Link and Doc'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => CustomOptions::GROUP_CUSTOM_OPTIONS_SCOPE,
                                'collapsible' => true,
                                'sortOrder' => 10
                            ],
                        ],
                    ],
                    'children' => [
                        CustomOptions::CONTAINER_HEADER_NAME => $this->getHeaderContainerConfig(10),
                        static::GRID_LINK_NAME => $this->getLinkGridConfig(30),
                        static::GRID_DOC_NAME => $this->getDocGridConfig(40),
                    ]
                ]
            ]
        );
        return $this;
    }
    protected function getHeaderContainerConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => null,
                        'formElement' => Container::NAME,
                        'componentType' => Container::NAME,
                        'template' => 'ui/form/components/complex',
                        'sortOrder' => $sortOrder,
                        'content' => __('Add links and document for course product.'),
                    ],
                ],
            ],
            'children' => [
                'button_link' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'title' => __('Add Link'),
                                'formElement' => Container::NAME,
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/form/components/button',
                                'sortOrder' => 20,
                                'actions' => [
                                    [
                                        'targetName' => '${ $.ns }.${ $.ns }.' . static::GROUP_CUSTOM_OPTIONS_NAME
                                            . '.' . static::GRID_LINK_NAME,
                                        '__disableTmpl' => ['targetName' => false],
                                        'actionName' => 'processingAddChild',
                                    ]
                                ]
                            ]
                        ],
                    ],
                ],
                'button_doc' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'title' => __('Import Files'),
                                'formElement' => Container::NAME,
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/form/components/button',
                                'sortOrder' => 30,
                                'actions' => [
                                    [
                                        'targetName' => '${ $.ns }.${ $.ns }.' . static::GROUP_CUSTOM_OPTIONS_NAME
                                            . '.' . static::GRID_DOC_NAME,
                                        '__disableTmpl' => ['targetName' => false],
                                        'actionName' => 'processingAddChild',
                                    ]
                                ]
                            ]
                        ],
                    ],
                ],
            ],
        ];
    }
    protected function getLinkGridConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel' => __('Add Link'),
                        'componentType' => DynamicRows::NAME,
                        'component' => 'Magento_Catalog/js/components/dynamic-rows-import-custom-options',
                        'template' => 'ui/dynamic-rows/templates/collapsible',
                        'additionalClasses' => 'admin__field-wide',
                        'deleteProperty' => CustomOptions::FIELD_IS_DELETE,
                        'deleteValue' => '1',
                        'addButton' => false,
                        'renderDefaultRecord' => false,
                        'columnsHeader' => false,
                        'collapsibleHeader' => true,
                        'sortOrder' => $sortOrder,
                        'dataProvider' => CustomOptions::CUSTOM_OPTIONS_LISTING,
                        'imports' => [
                            'insertData' => '${ $.provider }:${ $.dataProvider }',
                            '__disableTmpl' => ['insertData' => false],
                        ],
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'headerLabel' => __('New Link'),
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'positionProvider' => CustomOptions::CONTAINER_OPTION . '.' . CustomOptions::FIELD_SORT_ORDER_NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                            ],
                        ],
                    ],
                    'children' => [
                        CustomOptions::CONTAINER_OPTION => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => Fieldset::NAME,
                                        'collapsible' => true,
                                        'label' => null,
                                        'sortOrder' => 10,
                                        'opened' => true,
                                    ],
                                ],
                            ],
                            'children' => [
                                CustomOptions::FIELD_SORT_ORDER_NAME => [
                                    'arguments' => [
                                        'data' => [
                                            'config' => [
                                                'componentType' => Field::NAME,
                                                'sortOrder' => 10,
                                                'label' => __('Url'),
                                                'dataType' => 'string',
                                                'formElement' => 'input'
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ],
                ]
            ]
        ];
    }
    protected function getDocGridConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'addButtonLabel' => __('Import Files'),
                        'componentType' => DynamicRows::NAME,
                        'component' => 'Magento_Catalog/js/components/dynamic-rows-import-custom-options',
                        'template' => 'ui/dynamic-rows/templates/collapsible',
                        'additionalClasses' => 'admin__field-wide',
                        'deleteProperty' => CustomOptions::FIELD_IS_DELETE,
                        'deleteValue' => '1',
                        'addButton' => false,
                        'renderDefaultRecord' => false,
                        'columnsHeader' => false,
                        'collapsibleHeader' => true,
                        'sortOrder' => $sortOrder,
                        'dataProvider' => CustomOptions::CUSTOM_OPTIONS_LISTING,
                        'imports' => [
                            'insertData' => '${ $.provider }:${ $.dataProvider }',
                            '__disableTmpl' => ['insertData' => false],
                        ],
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'headerLabel' => __('New File'),
                                'componentType' => Container::NAME,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'positionProvider' => CustomOptions::CONTAINER_OPTION . '.' . CustomOptions::FIELD_SORT_ORDER_NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                            ],
                        ],
                    ],
                    'children' => [
                        CustomOptions::CONTAINER_OPTION => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => Fieldset::NAME,
                                        'collapsible' => true,
                                        'label' => null,
                                        'sortOrder' => 10,
                                        'opened' => true,
                                    ],
                                ],
                            ],
                            'children' => [
                                CustomOptions::FIELD_SORT_ORDER_NAME => [
                                    'arguments' => [
                                        'data' => [
                                            'config' => [
                                                'componentType' => 'fileUploader',
                                                'sortOrder' => 10,
                                                'component' => 'Magento_Downloadable/js/components/file-uploader',
                                                'elementTmpl' => 'Magento_Downloadable/components/file-uploader',
                                                'label' => __('Upload File'),
                                                'dataType' => 'string',
                                                'formElement' => 'fileUploader',
                                                'fileInputName' => 'samples',
                                                'uploaderConfig' => [
                                                    'url' => $this->urlBuilder->getUrl(
                                                        'adminhtml/downloadable_file/upload',
                                                        ['type' => 'samples', '_secure' => true]
                                                    ),
                                                ],
                                                'dataScope' => 'file',
                                                'validation' => [
                                                    'required-entry' => true,
                                                ],
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                        ]
                    ],
                ]
            ]
        ];
    }
//    protected function getLinkConfig($sortOrder)
//    {
//        return [
//            'arguments' => [
//                'data' => [
//                    'config' => [
//                        'addButtonLabel' => __('Add Link'),
//                        'componentType' => DynamicRows::NAME,
//                        'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows',
//                        'additionalClasses' => 'admin__field-wide',
//                        'deleteProperty' => static::FIELD_IS_DELETE,
//                        'deleteValue' => '1',
//                        'renderDefaultRecord' => false,
//                        'sortOrder' => $sortOrder,
//                    ],
//                ],
//            ],
//            'children' => [
//                'record' => [
//                    'arguments' => [
//                        'data' => [
//                            'config' => [
//                                'componentType' => Container::NAME,
//                                'component' => 'Magento_Ui/js/dynamic-rows/record',
//                                'positionProvider' => static::FIELD_SORT_ORDER_NAME,
//                                'isTemplate' => true,
//                                'is_collection' => true,
//                            ],
//                        ],
//                    ],
//                    'children' => [
//                        static::FIELD_NAME_SELECT => $this->getSelectFieldConfig(1),
//                        static::FIELD_IS_DELETE => $this->getIsDeleteFieldConfig(3)
//                        //Add as many fields as you want
//
//                    ]
//                ]
//            ]
//        ];
//    }
//
//    protected function getSelectFieldConfig($sortOrder)
//    {
//        return [
//            'arguments' => [
//                'data' => [
//                    'config' => [
//                        'label' => __('Links'),
//                        'componentType' => Field::NAME,
//                        'formElement' => 'input',
//                        // 'selectType' => 'optgroup',
//                        'dataScope' => static::FIELD_NAME_SELECT,
//                        'dataType' => 'string',
//                        'sortOrder' => $sortOrder,
//                        'visible' => true,
//                        'disabled' => false,
//                    ],
//                ],
//            ],
//        ];
//    }
//
//    protected function getIsDeleteFieldConfig($sortOrder)
//    {
//        return [
//            'arguments' => [
//                'data' => [
//                    'config' => [
//                        'componentType' => ActionDelete::NAME,
//                        'fit' => true,
//                        'sortOrder' => $sortOrder
//                    ],
//                ],
//            ],
//        ];
//    }
}
