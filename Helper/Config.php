<?php

declare(strict_types=1);

namespace Smetana\Garant\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    public const XML_PATH_GENERAL_ENABLED = 'smetana_garant/general/enabled';

    public const VARIANT_STANDARD = 'standard';
    public const VARIANT_COMPACT = 'compact';

    public const AREA_PDP = 'pdp';
    public const AREA_CART = 'cart';
    public const AREA_CHECKOUT = 'checkout';

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->isFlag(self::XML_PATH_GENERAL_ENABLED, $storeId);
    }

    public function isNoticeEnabled(?int $storeId = null): bool
    {
        return $this->isEnabled($storeId) && $this->isFlag('smetana_garant/notice/enabled', $storeId);
    }

    public function isLabelEnabled(?int $storeId = null): bool
    {
        return $this->isEnabled($storeId) && $this->isFlag('smetana_garant/label/enabled', $storeId);
    }

    /**
     * One mark per product: where a commercial guarantee exists the notice is dropped.
     */
    public function isNoticeHiddenWithLabel(?int $storeId = null): bool
    {
        return $this->isFlag('smetana_garant/general/hide_notice_with_label', $storeId);
    }

    public function isNoticeVisibleOn(string $area, ?int $storeId = null): bool
    {
        if (!$this->isNoticeEnabled($storeId)) {
            return false;
        }

        return match ($area) {
            self::AREA_PDP => $this->isFlag('smetana_garant/notice/show_on_pdp', $storeId),
            self::AREA_CART => $this->isFlag('smetana_garant/notice/show_in_cart', $storeId),
            self::AREA_CHECKOUT => $this->isFlag('smetana_garant/notice/show_in_checkout', $storeId),
            default => false,
        };
    }

    public function isLabelVisibleOn(string $area, ?int $storeId = null): bool
    {
        if (!$this->isLabelEnabled($storeId)) {
            return false;
        }

        return match ($area) {
            self::AREA_PDP => $this->isFlag('smetana_garant/label/show_on_pdp', $storeId),
            self::AREA_CART => $this->isFlag('smetana_garant/label/show_in_cart', $storeId),
            self::AREA_CHECKOUT => $this->isFlag('smetana_garant/label/show_in_checkout', $storeId),
            default => false,
        };
    }

    /**
     * Only the product page offers both sizes; cart and checkout always stay compact.
     */
    public function getNoticeVariant(string $area, ?int $storeId = null): string
    {
        if ($area !== self::AREA_PDP) {
            return self::VARIANT_COMPACT;
        }

        return $this->normalizeVariant($this->getValue('smetana_garant/notice/pdp_variant', $storeId));
    }

    public function getLabelVariant(string $area, ?int $storeId = null): string
    {
        if ($area !== self::AREA_PDP) {
            return self::VARIANT_COMPACT;
        }

        return $this->normalizeVariant($this->getValue('smetana_garant/label/pdp_variant', $storeId));
    }

    public function isNoticePdpExpanded(?int $storeId = null): bool
    {
        return $this->isFlag('smetana_garant/notice/pdp_expanded', $storeId);
    }

    public function isLabelPdpExpanded(?int $storeId = null): bool
    {
        return $this->isFlag('smetana_garant/label/pdp_expanded', $storeId);
    }

    public function getNoticeCmsPage(?int $storeId = null): string
    {
        return $this->getValue('smetana_garant/notice/cms_page', $storeId);
    }

    public function getNoticeLinkLabel(?int $storeId = null): string
    {
        $label = $this->getValue('smetana_garant/notice/link_label', $storeId);

        return $label !== '' ? $label : (string)__('Show full notice');
    }

    public function getNoticeQrUrl(?int $storeId = null): string
    {
        $url = $this->getValue('smetana_garant/notice/qr_url', $storeId);

        return $url !== ''
            ? $url
            : 'https://europa.eu/youreurope/citizens/consumers/shopping/guarantees/index_de.htm';
    }

    public function getLabelQrUrl(?int $storeId = null): string
    {
        $url = $this->getValue('smetana_garant/label/qr_url', $storeId);

        return $url !== ''
            ? $url
            : 'https://europa.eu/youreurope/citizens/consumers/shopping/commercial-guarantee-durability/index_de.htm';
    }

    public function getNoticeText(string $field, ?int $storeId = null): string
    {
        return $this->getValue('smetana_garant/notice/' . $field, $storeId);
    }

    public function getNoticeImageLanguage(?int $storeId = null): string
    {
        $language = $this->getValue('smetana_garant/notice/image_language', $storeId);

        return $language !== '' ? strtoupper($language) : 'DE';
    }

    public function getNoticeImageVariant(?int $storeId = null): string
    {
        $variant = $this->getValue('smetana_garant/notice/image_variant', $storeId);

        return $variant !== '' ? $variant : 'color';
    }

    public function getMinDuration(?int $storeId = null): float
    {
        $value = (float)$this->getValue('smetana_garant/label/min_duration', $storeId);

        return $value > 2 ? $value : 2.5;
    }

    public function getDefaultBrand(?int $storeId = null): string
    {
        return $this->getValue('smetana_garant/label/default_brand', $storeId);
    }

    public function getBrandAttribute(?int $storeId = null): string
    {
        return $this->getValue('smetana_garant/label/brand_attribute', $storeId);
    }

    public function getModelAttribute(?int $storeId = null): string
    {
        $attribute = $this->getValue('smetana_garant/label/model_attribute', $storeId);

        return $attribute !== '' ? $attribute : 'sku';
    }

    public function getDurationAttribute(?int $storeId = null): string
    {
        return $this->getValue('smetana_garant/label/duration_attribute', $storeId);
    }

    private function normalizeVariant(string $variant): string
    {
        return $variant === self::VARIANT_STANDARD ? self::VARIANT_STANDARD : self::VARIANT_COMPACT;
    }

    private function isFlag(string $path, ?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag($path, ScopeInterface::SCOPE_STORE, $storeId);
    }

    private function getValue(string $path, ?int $storeId = null): string
    {
        return trim((string)$this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $storeId));
    }
}
