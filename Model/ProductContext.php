<?php

declare(strict_types=1);

namespace Smetana\Garant\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Registry;
use Magento\Quote\Model\Quote\Item\AbstractItem;

/**
 * Product a mark belongs to: the line item where one exists, otherwise the
 * product of the current page.
 */
class ProductContext
{
    public function __construct(private readonly Registry $registry)
    {
    }

    public function resolve(mixed $item = null): ?ProductInterface
    {
        if ($item instanceof AbstractItem) {
            $product = $item->getProduct();

            return $product instanceof ProductInterface ? $product : null;
        }

        $product = $this->registry->registry('current_product') ?: $this->registry->registry('product');

        return $product instanceof ProductInterface ? $product : null;
    }
}
