<?php
namespace Magenest\Blog\Api\Data;
use Magento\Framework\Api\ExtensibleDataInterface;

interface BlogInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title);
    /**
     * @return string
     */
    public function getUrl();
    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url);

    /**
     * @return int
     */
    public function getAuthorId();

    /**
     * @param integer $id
     * @return void
     */
    public function setAuthorId($id);
}
