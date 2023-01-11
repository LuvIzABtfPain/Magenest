<?php

namespace Magenest\Knockout\Block;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;


class ModalOverlay extends Template
{
    protected $httpContext;
    private $blockRepository;

    public function __construct(
        BlockRepositoryInterface            $blockRepository,
        Context                             $context,
        \Magento\Framework\App\Http\Context $httpContext,
        array                               $data = []
    )
    {
        $this->blockRepository = $blockRepository;
        $this->httpContext = $httpContext;
        parent::__construct($context, $data);
    }

    public function getContent()
    {
        $content = "Rat nhieu uu dai";
        if ($this->httpContext->getValue('customer_logged_in')) {
            $customer_group = $this->httpContext->getValue('customer_group');
                switch ($customer_group) {
                    case 0:
                        $content = "Rat nhieu uu dai";
                        break;
                    case 1:
                        $content = "Uu dai 1";
                        break;
                    case 2:
                        $content = "Uu dai 2";
                        break;
                    case 3:
                        $content = "Uu dai 3";
                        break;
                    case 4:
                        $content = "Uu dai for B2B";
                        break;
                    default:
                        $content = "Uu dai";
                }
        }

        return $content;
    }
}
