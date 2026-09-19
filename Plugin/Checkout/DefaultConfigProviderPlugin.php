<?php

declare(strict_types=1);

namespace Smetana\Garant\Plugin\Checkout;

use Magento\Checkout\Model\DefaultConfigProvider;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\Model\DisplayRules;
use Smetana\Garant\Model\Label\LabelHtmlRenderer;
use Smetana\Garant\Model\Label\LabelResolver;

class DefaultConfigProviderPlugin
{
    public function __construct(
        private readonly DisplayRules $displayRules,
        private readonly LabelResolver $labelResolver,
        private readonly LabelHtmlRenderer $labelHtmlRenderer
    ) {
    }

    /**
     * Both marks are decided per line item, so the product switches apply in the checkout too.
     *
     * @param array<string, mixed> $result
     * @return array<string, mixed>
     */
    public function afterGetConfig(DefaultConfigProvider $subject, array $result): array
    {
        if (empty($result['quoteItemData']) || !is_array($result['quoteItemData'])) {
            return $result;
        }

        foreach ($result['quoteItemData'] as &$item) {
            $productId = (int)($item['product_id'] ?? 0);
            if ($productId <= 0) {
                continue;
            }

            $item['garant_notice'] = $this->displayRules->isNoticeVisible(Config::AREA_CHECKOUT, $productId);

            if (!$this->displayRules->isLabelVisible(Config::AREA_CHECKOUT, $productId)) {
                continue;
            }

            $label = $this->labelResolver->resolve($productId);
            if ($label === null) {
                continue;
            }

            $item['garant'] = $label->toArray() + [
                'html' => $this->labelHtmlRenderer->render($label),
            ];
        }

        return $result;
    }
}
