<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magenest\Movie\Block\Adminhtml\Form\Field\GroupColumn;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Courses extends AbstractFieldArray
{
    private $groupRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('time', ['label' => __('Time'), 'class' => 'required-entry']);
        $this->addColumn('group', [
            'label' => __('Group'),
            'renderer' => $this->getGroupRenderer()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    private function getGroupRenderer()
    {
        if (!$this->groupRenderer) {
            $this->groupRenderer = $this->getLayout()->createBlock(
                GroupColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->groupRenderer;
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $group = $row->getGroup();
        if ($group !== null) {
            $options['option_' . $this->getGroupRenderer()->calcOptionHash($group)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }
}
