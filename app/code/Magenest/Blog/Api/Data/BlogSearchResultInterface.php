<?php
namespace Magenest\Blog\Api\Data;

interface BlogSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Magenest\Blog\Api\Data\BlogInterface[]
     */
    public function getItems();

    /**
     * @param \Magenest\Blog\Api\Data\BlogInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
