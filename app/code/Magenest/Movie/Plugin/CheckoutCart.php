<?php

namespace Magenest\Movie\Plugin;
use Magento\Catalog\Api\ProductRepositoryInterface;

class CheckoutCart
{
    private $productRepository;
    public function __construct(
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }
    public function getProductBySku($subject){
        $sku = $subject->getItem()->getData('sku');
        $product = $this->productRepository->get($sku);
        return $product;
    }
    public function afterGetProductName($subject)
    {
        $product = $this->getProductBySku($subject);
        return $product->getName();
    }
    public function afterGetProductForThumbnail($subject)
    {
        return $this->getProductBySku($subject);
    }
}
