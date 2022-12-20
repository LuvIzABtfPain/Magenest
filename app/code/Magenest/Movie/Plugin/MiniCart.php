<?php

namespace Magenest\Movie\Plugin;
use \Magento\Catalog\Api\ProductRepositoryInterface;

class CheckoutCart
{
    private $productRepository;
    public function __construct(
    ProductRepositoryInterface $productRepository
) {
    $this->productRepository = $productRepository;
}
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }
    public function afterGetItemData($subject, $proceed, $item)

    {
        $result = $proceed($item);
        $product = $this->productRepository->create()->getProductBySku($item->getSku());
        $result['product_name'] = $product->getName();
        return $result;

    }
}
