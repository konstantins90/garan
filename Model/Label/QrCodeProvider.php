<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Label;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Magento\Framework\App\CacheInterface;
use Smetana\Garant\Helper\Config;

class QrCodeProvider
{
    private const CACHE_TAG = 'smetana_garant_qr';

    public function __construct(
        private readonly CacheInterface $cache,
        private readonly Config $config
    ) {
    }

    public function getNoticeQrUrl(): string
    {
        return $this->config->getNoticeQrUrl();
    }

    public function getLabelQrUrl(): string
    {
        return $this->config->getLabelQrUrl();
    }

    public function getNoticeQrSvg(): string
    {
        return $this->getSvg($this->getNoticeQrUrl());
    }

    public function getLabelQrSvg(): string
    {
        return $this->getSvg($this->getLabelQrUrl());
    }

    /**
     * Standalone QR document for use in an SVG <image> or CSS background.
     */
    public function getLabelQrDocument(): string
    {
        return $this->getSvg($this->getLabelQrUrl(), true);
    }

    public function getSvg(string $url, bool $standalone = false): string
    {
        if ($url === '') {
            return '';
        }

        $cacheKey = self::CACHE_TAG . '_' . ($standalone ? 'doc_' : '') . hash('sha256', $url);
        $cached = $this->cache->load($cacheKey);
        if (is_string($cached) && $cached !== '') {
            return $cached;
        }

        $svg = $this->generateSvg($url, $standalone);
        if ($svg !== '') {
            $this->cache->save($svg, $cacheKey, [self::CACHE_TAG], 86400);
        }

        return $svg;
    }

    private function generateSvg(string $url, bool $standalone): string
    {
        if (!class_exists(QrCode::class) || !class_exists(SvgWriter::class)) {
            return '';
        }

        try {
            $qrCode = new QrCode(data: $url, size: 180, margin: 0);
            $writer = new SvgWriter();
            $result = $writer->write($qrCode, null, null, [
                SvgWriter::WRITER_OPTION_EXCLUDE_XML_DECLARATION => true,
                SvgWriter::WRITER_OPTION_EXCLUDE_SVG_WIDTH_AND_HEIGHT => !$standalone,
            ]);

            return $result->getString();
        } catch (\Throwable) {
            return '';
        }
    }
}
