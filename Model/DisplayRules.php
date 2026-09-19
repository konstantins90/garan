<?php

declare(strict_types=1);

namespace Smetana\Garant\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\Model\Label\LabelResolver;

/**
 * Decides per product which of the two marks is shown: store configuration,
 * product switch and, optionally, the rule that a guarantee replaces the notice.
 */
class DisplayRules
{
    public const ATTRIBUTE_NOTICE = 'garant_notice_enabled';
    public const ATTRIBUTE_LABEL = 'garant_label_enabled';

    /** @var array<int, ProductInterface|null> */
    private array $products = [];

    public function __construct(
        private readonly Config $config,
        private readonly LabelResolver $labelResolver,
        private readonly ProductRepositoryInterface $productRepository
    ) {
    }

    public function isNoticeVisible(string $area, ProductInterface|int|null $product = null): bool
    {
        if (!$this->config->isNoticeVisibleOn($area)
            || !$this->isAllowedForProduct($product, self::ATTRIBUTE_NOTICE)
        ) {
            return false;
        }

        return !$this->config->isNoticeHiddenWithLabel() || !$this->hasGuarantee($product);
    }

    public function isLabelVisible(string $area, ProductInterface|int|null $product = null): bool
    {
        return $this->config->isLabelVisibleOn($area)
            && $this->isAllowedForProduct($product, self::ATTRIBUTE_LABEL);
    }

    /**
     * A commercial guarantee exists when the label is switched on for the product
     * and the data of Annex II is complete.
     */
    public function hasGuarantee(ProductInterface|int|null $product): bool
    {
        return $this->config->isLabelEnabled()
            && $this->isAllowedForProduct($product, self::ATTRIBUTE_LABEL)
            && $this->labelResolver->resolve($product) !== null;
    }

    /**
     * Without a value and with "use config" the store configuration decides.
     */
    private function isAllowedForProduct(ProductInterface|int|null $product, string $attribute): bool
    {
        $value = $this->readFlag($product, $attribute);

        return $value === null || (int)$value !== 0;
    }

    private function readFlag(ProductInterface|int|null $product, string $attribute): ?string
    {
        $product = $this->loadProduct($product);
        if ($product === null) {
            return null;
        }

        $value = $product->getData($attribute);

        return $value === null || $value === '' ? null : (string)$value;
    }

    /**
     * Quote items and listings do not always carry the switches, so the product
     * is reloaded once per request.
     */
    private function loadProduct(ProductInterface|int|null $product): ?ProductInterface
    {
        if ($product instanceof ProductInterface
            && ($product->getData(self::ATTRIBUTE_NOTICE) !== null
                || $product->getData(self::ATTRIBUTE_LABEL) !== null)
        ) {
            return $product;
        }

        $productId = $product instanceof ProductInterface ? (int)$product->getId() : (int)$product;
        if ($productId <= 0) {
            return $product instanceof ProductInterface ? $product : null;
        }

        if (!array_key_exists($productId, $this->products)) {
            try {
                $this->products[$productId] = $this->productRepository->getById($productId);
            } catch (NoSuchEntityException) {
                $this->products[$productId] = $product instanceof ProductInterface ? $product : null;
            }
        }

        return $this->products[$productId];
    }
}
