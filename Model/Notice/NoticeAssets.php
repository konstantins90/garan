<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Notice;

use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Filesystem\Directory\ReadFactory;

/**
 * Delivered artwork of the harmonised notice (Annex I): one image and one PDF per language.
 *
 * The directories are read at runtime, so a new language only has to be dropped into
 * view/frontend/web/img as notice-<code>.png (optionally notice-<code>-bw.png) and into
 * view/frontend/web/pdf as notice-<code>.pdf.
 */
class NoticeAssets
{
    public const VARIANT_COLOR = 'color';
    public const VARIANT_BW = 'bw';

    private const MODULE = 'Smetana_Garant';
    private const IMAGE_DIR = 'view/frontend/web/img';
    private const PDF_DIR = 'view/frontend/web/pdf';

    /** @var array<string, array<string, string>>|null */
    private ?array $images = null;

    /** @var array<string, string>|null */
    private ?array $pdfs = null;

    public function __construct(
        private readonly ComponentRegistrar $componentRegistrar,
        private readonly ReadFactory $readFactory
    ) {
    }

    /**
     * Language codes with an image, e.g. ['BG', 'CS', 'DE'].
     *
     * @return string[]
     */
    public function getImageLanguages(): array
    {
        return array_keys($this->loadImages());
    }

    /**
     * Asset id of the image, empty when the language is not delivered.
     */
    public function getImagePath(string $language, string $variant = self::VARIANT_COLOR): string
    {
        $files = $this->loadImages()[strtoupper($language)] ?? [];
        $file = $files[$variant] ?? $files[self::VARIANT_COLOR] ?? null;

        return $file === null ? '' : self::MODULE . '::img/' . $file;
    }

    /**
     * Asset id of the PDF, empty when the language is not delivered.
     */
    public function getPdfPath(string $language): string
    {
        $file = $this->loadPdfs()[strtoupper($language)] ?? null;

        return $file === null ? '' : self::MODULE . '::pdf/' . $file;
    }

    /**
     * Language code => asset id of the PDF.
     *
     * @return array<string, string>
     */
    public function getPdfPaths(): array
    {
        $paths = [];
        foreach ($this->loadPdfs() as $language => $file) {
            $paths[$language] = self::MODULE . '::pdf/' . $file;
        }

        return $paths;
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function loadImages(): array
    {
        if ($this->images === null) {
            $this->images = [];
            foreach ($this->read(self::IMAGE_DIR) as $file) {
                if (preg_match('/^notice-([a-z]{2})(-bw)?\.png$/', $file, $match) !== 1) {
                    continue;
                }

                $variant = ($match[2] ?? '') === '' ? self::VARIANT_COLOR : self::VARIANT_BW;
                $this->images[strtoupper($match[1])][$variant] = $file;
            }

            ksort($this->images);
        }

        return $this->images;
    }

    /**
     * @return array<string, string>
     */
    private function loadPdfs(): array
    {
        if ($this->pdfs === null) {
            $this->pdfs = [];
            foreach ($this->read(self::PDF_DIR) as $file) {
                if (preg_match('/^notice-([a-z]{2})\.pdf$/', $file, $match) !== 1) {
                    continue;
                }

                $this->pdfs[strtoupper($match[1])] = $file;
            }

            ksort($this->pdfs);
        }

        return $this->pdfs;
    }

    /**
     * @return string[]
     */
    private function read(string $directory): array
    {
        $modulePath = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, self::MODULE);
        if ($modulePath === null) {
            return [];
        }

        try {
            return array_map('basename', $this->readFactory->create($modulePath . '/' . $directory)->read());
        } catch (\Throwable) {
            return [];
        }
    }
}
