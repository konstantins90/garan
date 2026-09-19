<?php

declare(strict_types=1);

namespace Smetana\Garant\ViewModel;

use Magento\Framework\View\Asset\Repository as AssetRepository;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\Model\DisplayRules;
use Smetana\Garant\Model\Icon\EuShield;
use Smetana\Garant\Model\Icon\GaranCheck;
use Smetana\Garant\Model\Label\QrCodeProvider;
use Smetana\Garant\Model\Notice\NoticeAssets;
use Smetana\Garant\Model\Notice\NoticeUrl;
use Smetana\Garant\Model\ProductContext;

class NoticeViewModel implements ArgumentInterface
{
    public function __construct(
        private readonly Config $config,
        private readonly NoticeUrl $noticeUrl,
        private readonly QrCodeProvider $qrCodeProvider,
        private readonly EuShield $euShield,
        private readonly GaranCheck $garanCheck,
        private readonly NoticeAssets $noticeAssets,
        private readonly AssetRepository $assetRepository,
        private readonly DisplayRules $displayRules,
        private readonly ProductContext $productContext
    ) {
    }

    /**
     * Configuration, product switch and the rule for the product of the current page.
     */
    public function isVisibleOn(string $area): bool
    {
        return $this->displayRules->isNoticeVisible($area, $this->productContext->resolve());
    }

    public function getVariant(string $area): string
    {
        return $this->config->getNoticeVariant($area);
    }

    public function isPdpExpanded(): bool
    {
        return $this->config->isNoticePdpExpanded();
    }

    public function getFullPageUrl(): string
    {
        return $this->noticeUrl->getUrl();
    }

    public function getLinkLabel(): string
    {
        return $this->config->getNoticeLinkLabel();
    }

    public function getText(string $field): string
    {
        return $this->config->getNoticeText($field);
    }

    public function getQrSvg(): string
    {
        return $this->qrCodeProvider->getNoticeQrSvg();
    }

    public function getQrUrl(): string
    {
        return $this->qrCodeProvider->getNoticeQrUrl();
    }

    public function getQrCaption(): string
    {
        $caption = $this->config->getNoticeText('qr_caption');
        if ($caption !== '') {
            return $caption;
        }

        $host = parse_url($this->getQrUrl(), PHP_URL_HOST);
        $path = parse_url($this->getQrUrl(), PHP_URL_PATH);

        return ltrim((string)$host . (string)$path, '/');
    }

    public function getEuShieldSvg(
        string $body = '#ffffff',
        string $star = '#034ea2',
        string $letter = '#034ea2'
    ): string {
        return $this->euShield->render($body, $star, $letter);
    }

    /**
     * Emblem in the colours of the printed artwork: blue shield, yellow stars.
     */
    public function getArtworkShieldSvg(): string
    {
        return $this->euShield->render();
    }

    public function getCheckSvg(string $disc = 'currentColor', string $tick = '#ffffff'): string
    {
        return $this->garanCheck->render($disc, $tick);
    }

    public function getImageLanguage(): string
    {
        return $this->config->getNoticeImageLanguage();
    }

    /**
     * URL of the official notice artwork in the configured language, empty when not delivered.
     */
    public function getImageUrl(): string
    {
        $path = $this->noticeAssets->getImagePath(
            $this->getImageLanguage(),
            $this->config->getNoticeImageVariant()
        );

        return $path === '' ? '' : $this->assetRepository->getUrl($path);
    }

    /**
     * PDF of the notice in the configured language, empty when not delivered.
     */
    public function getPdfUrl(): string
    {
        $path = $this->noticeAssets->getPdfPath($this->getImageLanguage());

        return $path === '' ? '' : $this->assetRepository->getUrl($path);
    }

    /**
     * Language code => PDF URL for every delivered language.
     *
     * @return array<string, string>
     */
    public function getPdfUrls(): array
    {
        $urls = [];
        foreach ($this->noticeAssets->getPdfPaths() as $language => $path) {
            $urls[$language] = $this->assetRepository->getUrl($path);
        }

        return $urls;
    }
}
