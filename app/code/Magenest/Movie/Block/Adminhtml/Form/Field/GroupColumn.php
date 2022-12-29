<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Customer\Model\Config\Source\Group;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;

class GroupColumn extends Select
{
    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */
    protected $group_options;

    public function __construct(Context $context, Group $group_options, array $data = [])
    {
        parent::__construct($context, $data);
        $this->group_options = $group_options;
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param $value
     * @return $this
     */
    public function setInputId($value)
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    private function getSourceOptions(): array
    {
        return $this->group_options->toOptionArray();
    }
}
