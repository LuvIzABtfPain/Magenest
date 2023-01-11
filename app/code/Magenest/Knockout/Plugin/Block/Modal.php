<?php

namespace Magenest\Knockout\Plugin\Block;
use Magento\Framework\Data\Tree\NodeFactory;
class Modal
{
    public function __construct(
        NodeFactory $nodeFactory,
        \Magento\Framework\UrlInterface $urlInterface
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->urlInterface = $urlInterface;
    }
    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
                                          $outermostClass = '',
                                          $childrenWrapClass = '',
                                          $limit = 0
    ) {
        $node = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray(),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }
    public function getNodeAsArray()
    {
        return [
            'name' => __('Modal'),
            'id' => 'Modal-offers-menu',
            'url' => $this->urlInterface->getUrl('movie/index/modal'),
            'has_active' => false,
            'is_active' => $this->isActive()
        ];
    }

    private function isActive()
    {
        $activeUrls = 'movie/index/modal';
        $currentUrl = $this->urlInterface->getCurrentUrl();
        if (strpos($currentUrl, $activeUrls) !== false) {
            return true;
        }
        return false;
    }
}
