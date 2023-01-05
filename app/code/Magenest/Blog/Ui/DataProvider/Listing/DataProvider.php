<?php

namespace Magenest\Blog\Ui\DataProvider\Listing;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;
use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    protected $collection;
    public function __construct($name, $primaryFieldName, $requestFieldName, CollectionFactory $collection, ReportingInterface $reporting, SearchCriteriaBuilder $searchCriteriaBuilder, RequestInterface $request, FilterBuilder $filterBuilder, array $meta = [], array $data = [])
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $filterBuilder, $meta, $data);
        $this->collection = $collection;
    }
    protected function searchResultToOutput(SearchResultInterface $searchResult)
    {
        $arrItems = [];

        $arrItems['items'] = [];
        foreach ($searchResult->getItems() as $item) {
            $itemData = [];
            $id = $item->getCustomAttribute('id')->getValue();
            $record = $this->collection->create()->getItemById($id)->getData();
            $itemData = array_splice($record, 0, 14);
            $arrItems['items'][] = $itemData;
        }

        $arrItems['totalRecords'] = $searchResult->getTotalCount();

        return $arrItems;
    }
}
