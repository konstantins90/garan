<?php

declare(strict_types=1);

namespace Smetana\Garant\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Quote\Model\Quote\Item\AbstractItem;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\Model\DisplayRules;
use Smetana\Garant\Model\Icon\EuShield;
use Smetana\Garant\Model\Icon\GaranCheck;
use Smetana\Garant\Model\Label\Artwork;
use Smetana\Garant\Model\Label\LabelData;
use Smetana\Garant\Model\Label\LabelResolver;
use Smetana\Garant\Model\Label\LanguageStrings;
use Smetana\Garant\Model\Label\QrCodeProvider;
use Smetana\Garant\Model\ProductContext;

class LabelViewModel implements ArgumentInterface
{
    public function __construct(
        private readonly Config $config,
        private readonly LabelResolver $labelResolver,
        private readonly LanguageStrings $languageStrings,
        private readonly QrCodeProvider $qrCodeProvider,
        private readonly Registry $registry,
        private readonly EuShield $euShield,
        private readonly GaranCheck $garanCheck,
        private readonly Artwork $artwork,
        private readonly DisplayRules $displayRules,
        private readonly ProductContext $productContext
    ) {
    }

    /**
     * Configuration and product switch for the product of the current page.
     */
    public function isVisibleOn(string $area): bool
    {
        return $this->displayRules->isLabelVisible($area, $this->productContext->resolve());
    }

    public function getVariant(string $area): string
    {
        return $this->config->getLabelVariant($area);
    }

    public function isPdpExpanded(): bool
    {
        return $this->config->isLabelPdpExpanded();
    }

    public function resolveCurrentProduct(): ?LabelData
    {
        $product = $this->registry->registry('current_product')
            ?: $this->registry->registry('product');

        return $product instanceof ProductInterface ? $this->labelResolver->resolve($product) : null;
    }

    public function resolveProduct(ProductInterface|int|string|null $product): ?LabelData
    {
        return $this->labelResolver->resolve($product);
    }

    public function resolveItem(?AbstractItem $item): ?LabelData
    {
        if ($item === null) {
            return null;
        }

        return $this->labelResolver->resolve($item->getProduct());
    }

    /**
     * Upper panel of the harmonised label as inline SVG.
     */
    public function getLabelSvg(LabelData $labelData): string
    {
        return $this->artwork->renderPanel(
            $labelData,
            $this->qrCodeProvider->getLabelQrDocument(),
            $this->qrCodeProvider->getLabelQrUrl()
        );
    }

    /**
     * Nested (compact) format as inline SVG.
     */
    public function getBadgeSvg(LabelData $labelData): string
    {
        return $this->artwork->renderBadge($labelData);
    }

    /**
     * Language code => wording of the multilingual footer.
     *
     * @return array<string, string>
     */
    public function getFooterEntries(): array
    {
        return $this->languageStrings->getFooterEntries();
    }

    /**
     * @return string[]
     */
    public function getFooterLines(): array
    {
        return $this->languageStrings->getFooterLines();
    }

    /**
     * Multilingual footer as one running text for the label.
     */
    public function getFooterHtml(): string
    {
        return $this->languageStrings->getFooterHtml();
    }

    public function getQrSvg(): string
    {
        return $this->qrCodeProvider->getLabelQrSvg();
    }

    public function getQrUrl(): string
    {
        return $this->qrCodeProvider->getLabelQrUrl();
    }

    public function getEuShieldSvg(
        string $body = '#034ea2',
        string $star = '#fff200',
        string $letter = '#ffffff'
    ): string {
        return $this->euShield->render($body, $star, $letter);
    }

    public function getCheckSvg(string $disc = '#000000', string $tick = '#ffffff'): string
    {
        return $this->garanCheck->render($disc, $tick);
    }
}
