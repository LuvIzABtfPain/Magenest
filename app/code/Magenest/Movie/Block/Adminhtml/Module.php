<?php

namespace Magenest\Movie\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Context;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\Module\FullModuleList;

class Module extends Template
{
    protected $fullModuleList;
    public function __construct(Template\Context $context, FullModuleList $fullModuleList, array $data = [], ?JsonHelper $jsonHelper = null, ?DirectoryHelper $directoryHelper = null)
    {
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
        $this->_headerText = __('Modules');
        $this->fullModuleList = $fullModuleList;
    }

    public function getModules(){
        return $this->fullModuleList->getNames();
    }

}
