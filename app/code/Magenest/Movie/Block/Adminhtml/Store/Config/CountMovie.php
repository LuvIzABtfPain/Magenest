<?php

namespace Magenest\Movie\Block\Adminhtml\Store\Config;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as CollectionMovieFactory;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class CountMovie extends Field
{
    protected $moviesFactory;

    public function __construct(
        Context             $context,
        CollectionMovieFactory             $moviesFactory,
        array               $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        $this->moviesFactory = $moviesFactory;
        parent::__construct($context, $data, $secureRenderer);
    }

    protected function _getElementHtml(AbstractElement $element): int
    {
        $html = $this->moviesFactory->create()->getSize();
        return $html;
    }
}
