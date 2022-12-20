<?php

namespace Magenest\Movie\Plugin;
use \Magento\Catalog\Api\ProductRepositoryInterface;
use \Magento\Catalog\Helper\Image;

class MiniCart
{
    private $productRepository;
    protected $imageHelper;
    public function __construct(
    ProductRepositoryInterface $productRepository,
    Image $imageHelper,
) {
    $this->productRepository = $productRepository;
    $this->imageHelper = $imageHelper;
}
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }
    public function afterGetItemData($subject, $result, $item)

    {
        if($item->getProductType() == 'configurable')
        {
            $product = $this->getProductBySku($item->getSku());
            $imageHelper = $this->imageHelper->init($product, 'mini_cart_product_thumbnail');
            $result['product_name'] = $product->getName();
            $result['product_image']['src'] = $imageHelper->getUrl();
            return $result;
        }

    }
}
