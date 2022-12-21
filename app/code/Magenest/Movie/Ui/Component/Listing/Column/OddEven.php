<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class OddEven extends Column
{
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if($item['entity_id'] %2 == 0){
                    $item['odd_even'] = '<span class="grid-severity-notice"><span>Even</span></span>';
                } else $item['odd_even'] = '<span class="grid-severity-critical"><span>Odd</span></span>';
            }
        }

        return $dataSource;    }
}
