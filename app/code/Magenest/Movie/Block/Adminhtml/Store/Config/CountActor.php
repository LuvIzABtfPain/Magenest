<?php

namespace Magenest\Movie\Block\Adminhtml\Store\Config;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as CollectionActorFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class CountActor extends Field
{
    protected $actorsFactory;

    public function __construct(
        Context             $context,
        CollectionActorFactory             $actorsFactory,
        array               $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        $this->actorsFactory = $actorsFactory;
        parent::__construct($context, $data, $secureRenderer);
    }

    protected function _getElementHtml(AbstractElement $element): int
    {
        $html = $this->actorsFactory->create()->getSize();
        return $html;
    }
}
