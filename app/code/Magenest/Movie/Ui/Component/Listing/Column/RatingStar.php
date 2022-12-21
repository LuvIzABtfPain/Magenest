<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class RatingStar extends Column
{


    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);

    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $i = 0;
                $html = null;
                while ($i < 10) {
                    if ($i < $item['rating']) {
                        $html .= '<span>&#9733;</span>';
                    } else {
                        $html .= '<span>&#9734;</span>';
                    }
                    $i++;
                }
                $item['rating'] = $html;
            }
        }

        return $dataSource;
    }
}

