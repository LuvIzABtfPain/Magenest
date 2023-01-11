<?php

namespace Magenest\Knockout\Block\Adminhtml;

class ColorPicker extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    protected $colorRenderer;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, array $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _prepareToRender()
    {
        $this->addColumn('color', ['label' => __('Color'), 'class' => 'required-entry']);
        $this->addColumn('value', ['label' => __('Value'), 'class' => 'required-entry', 'renderer' => $this->getColorRenderer(),]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
    private function getColorRenderer()
    {
        if (!$this->colorRenderer) {
            $this->colorRenderer = $this->getLayout()->createBlock(
                \Magenest\Knockout\Block\Adminhtml\Blocks\Edit\Tab\ColorRenderer::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->colorRenderer;
    }
}
