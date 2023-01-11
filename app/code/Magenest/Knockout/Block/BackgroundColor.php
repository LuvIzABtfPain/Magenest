<?php

namespace Magenest\Knockout\Block;

use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class BackgroundColor extends Template
{
    protected $scopeConfig;
    protected $jsonHelper;
    public function __construct(Template\Context $context, SerializerInterface $jsonHelper, ScopeConfigInterface $scopeConfig, array $data = [], ?DirectoryHelper $directoryHelper = null)
    {
        $this->scopeConfig = $scopeConfig;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context, $data, $directoryHelper);
    }
    public function getAllOptions(){
        $jsonres = $this->scopeConfig->getValue('background_color/general/bgr_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $this->jsonHelper->unserialize($jsonres);
    }
}
