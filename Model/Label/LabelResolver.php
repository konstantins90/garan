<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Label;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\NoSuchEntityException;
use Smetana\Garant\Helper\Config;

class LabelResolver
{
    /** @var array<int, LabelData|null> */
    private array $memo = [];

    public function __construct(
        private readonly Config $config,
        private readonly ProductRepositoryInterface $productRepository
    ) {
    }

    public function resolve(ProductInterface|int|string|null $product): ?LabelData
    {
        if (!$this->config->isLabelEnabled()) {
            return null;
        }

        $product = $this->loadProduct($product);
        if ($product === null || !(int)$product->getId()) {
            return null;
        }

        $productId = (int)$product->getId();
        if (array_key_exists($productId, $this->memo)) {
            return $this->memo[$productId];
        }

        $duration = $this->resolveDuration($product);
        $brand = $this->resolveBrand($product);
        $modelId = $this->resolveModelId($product);

        if ($duration <= 2 || $duration < $this->config->getMinDuration() || $brand === '' || $modelId === '') {
            $this->memo[$productId] = null;
            return null;
        }

        $this->memo[$productId] = new LabelData($duration, $brand, $modelId, $productId);

        return $this->memo[$productId];
    }

    private function resolveDuration(ProductInterface $product): float
    {
        $raw = $this->firstNonEmpty([
            $product->getData('garant_duration'),
            $this->readMappedAttribute($product, $this->config->getDurationAttribute()),
        ]);

        if ($raw === '') {
            return 0.0;
        }

        $duration = (float)str_replace(',', '.', $raw);
        $duration = round($duration * 2) / 2;

        return max(0.0, $duration);
    }

    private function resolveBrand(ProductInterface $product): string
    {
        return $this->firstNonEmpty([
            $this->readAttributeValue($product, 'garant_brand'),
            $this->readMappedAttribute($product, $this->config->getBrandAttribute()),
            $this->config->getDefaultBrand(),
        ]);
    }

    private function resolveModelId(ProductInterface $product): string
    {
        return $this->firstNonEmpty([
            $this->readAttributeValue($product, 'garant_model_id'),
            $this->readMappedAttribute($product, $this->config->getModelAttribute()),
        ]);
    }

    private function readMappedAttribute(ProductInterface $product, string $code): string
    {
        if ($code === '') {
            return '';
        }

        if ($code === 'sku') {
            return trim((string)$product->getSku());
        }

        return $this->readAttributeValue($product, $code);
    }

    private function readAttributeValue(ProductInterface $product, string $code): string
    {
        if ($code === '') {
            return '';
        }

        $value = $product->getData($code);
        if (is_array($value)) {
            $value = reset($value);
        }

        $text = trim((string)$value);
        if ($text === '' || $text === '0') {
            return $text === '0' && $code === 'garant_duration' ? '0' : ($text === '0' ? '' : $text);
        }

        if ($product instanceof Product) {
            $attribute = $product->getResource()->getAttribute($code);
            if ($attribute && $attribute->usesSource()) {
                $label = $attribute->getSource()->getOptionText($value);
                if (is_array($label)) {
                    $label = implode(', ', $label);
                }
                $label = trim((string)$label);
                if ($label !== '') {
                    return $label;
                }
            }
        }

        return $text;
    }

    /**
     * @param array<int, mixed> $values
     */
    private function firstNonEmpty(array $values): string
    {
        foreach ($values as $value) {
            $text = trim((string)$value);
            if ($text !== '') {
                return $text;
            }
        }

        return '';
    }

    private function loadProduct(ProductInterface|int|string|null $product): ?ProductInterface
    {
        if ($product instanceof ProductInterface) {
            if ($product->getData('garant_duration') !== null
                || $product->getData('garant_brand') !== null
                || $product->getData('garant_model_id') !== null
            ) {
                return $product;
            }

            try {
                return $this->productRepository->getById((int)$product->getId());
            } catch (NoSuchEntityException) {
                return $product;
            }
        }

        if ($product === null || $product === '' || (int)$product <= 0) {
            return null;
        }

        try {
            return $this->productRepository->getById((int)$product);
        } catch (NoSuchEntityException) {
            return null;
        }
    }
}
