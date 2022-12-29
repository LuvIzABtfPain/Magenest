<?php
namespace Magenest\Product\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\DataType\Date;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Field;

class CustomFieldset extends AbstractModifier
{
    // Components indexes
    const CUSTOM_FIELDSET_INDEX = 'custom_fieldset';
    const CUSTOM_FIELDSET_CONTENT = 'custom_fieldset_content';
    const CONTAINER_HEADER_NAME = 'custom_fieldset_content_header';

    // Fields names
    const FIELD_NAME_SELECT = 'course_start';

    /**
     * @var \Magento\Catalog\Model\Locator\LocatorInterface
     */
    protected $locator;

    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        LocatorInterface $locator,
        ArrayManager     $arrayManager,
        UrlInterface     $urlBuilder
    )
    {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Data modifier, does nothing in our example.
     *
     * @param array $data
     * @return array
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Meta-data modifier: adds ours fieldset
     *
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;

        if(isset($meta['course-start'])) {
            $this->addCustomFieldset();
            unset($this->meta['course-start']);
        }

        return $this->meta;
    }

    /**
     * Merge existing meta-data with our meta-data (do not overwrite it!)
     *
     * @return void
     */
    protected function addCustomFieldset()
    {
        $this->meta = array_merge_recursive(
            $this->meta,
            [
                static::CUSTOM_FIELDSET_INDEX => $this->getFieldsetConfig(),
            ]
        );
    }

    /**
     * Declare ours fieldset config
     *
     * @return array
     */
    protected function getFieldsetConfig()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Course Start'),
                        'componentType' => Fieldset::NAME,
                        'dataScope' => static::DATA_SCOPE_PRODUCT, // save data in the product data
                        'provider' => static::DATA_SCOPE_PRODUCT . '_data_source',
                        'ns' => static::FORM_NAME,
                        'collapsible' => true,
                        'sortOrder' => 10,
                        'opened' => true,
                    ],
                ],
            ],
            'children' => [
                static::CONTAINER_HEADER_NAME => $this->getHeaderContainerConfig(10),
                static::FIELD_NAME_SELECT => $this->getSelectFieldConfig(30),
            ],
        ];
    }

    /**
     * Get config for header container
     *
     * @param int $sortOrder
     * @return array
     */
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
                        'content' => __('You can write any text here'),
                    ],
                ],
            ],
            'children' => [],
        ];
    }


    /**
     * Example select field config
     *
     * @param $sortOrder
     * @return array
     */
    protected function getSelectFieldConfig($sortOrder)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Course Start Date'),
                        'componentType' => Field::NAME,
                        'formElement' => Date::NAME,
                        'dataScope' => static::FIELD_NAME_SELECT,
                        'dataType' => 'string',
                        'sortOrder' => $sortOrder,
                        'options' => [
                            'dateFormat' => 'yyyy-MM-dd',
                            'showsTime' => true,
                        ],
                        'visible' => true,
                        'disabled' => false,
                    ],
                ],
            ],
        ];
    }


}

