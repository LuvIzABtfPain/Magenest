<?php
/**
* Copyright © Magento, Inc. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Magenest\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
* CMS page CRUD interface.
* @api
* @since 100.0.2
*/
interface BlogRepositoryInterface
{
/**
* Save page.
*
* @param \Magenest\Blog\Api\Data\BlogInterface $page
* @return \Magenest\Blog\Api\Data\BlogInterface
* @throws \Magento\Framework\Exception\LocalizedException
*/
public function save(\Magenest\Blog\Api\Data\BlogInterface $blog);

/**
* Retrieve page.
*
* @param int $id
* @return \Magenest\Blog\Api\Data\BlogInterface
* @throws \Magento\Framework\Exception\LocalizedException
*/
public function getById($id);

/**
* Retrieve pages matching the specified criteria.
*
* @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
* @return \Magenest\Blog\Api\Data\BlogSearchResultsInterface
* @throws \Magento\Framework\Exception\LocalizedException
*/

public function delete(\Magenest\Blog\Api\Data\BlogInterface $blog);

/**
* Delete page by ID.
*
* @param int $id
* @return bool true on success
* @throws \Magento\Framework\Exception\NoSuchEntityException
* @throws \Magento\Framework\Exception\LocalizedException
*/
public function deleteById($id);
}
