<?php

namespace Magenest\Chapter9\Block;

use Magento\Backend\Block\Template;
use Magento\Customer\Model\Session;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Store\Model\StoreManagerInterface;

class Banner extends Template
{
    protected $httpContext;
    protected $storeManager;
    public function __construct(Template\Context $context, HttpContext $httpContext, Session $customerSession, StoreManagerInterface $storeManager, array $data = [], ?JsonHelper $jsonHelper = null, ?DirectoryHelper $directoryHelper = null)
    {
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
        $this->storeManager = $storeManager;
        $this->httpContext = $httpContext;
    }

    public function getMediaUrl()
    {
        if ($this->httpContext->getValue('customer_logged_in')) {
            if ($this->httpContext->getValue('customer_group') == 4) {
                return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            }
        }
        return null;
    }

}
