<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Label;

/**
 * Multilingual footer of the harmonised guarantee label ("producer guarantee in years").
 *
 * Wording and order follow the official artwork of Annex II.
 */
class LanguageStrings
{
    private const ENTRIES = [
        'BG' => 'Гаранция от производителя в години',
        'CS' => 'Záruka výrobce v letech',
        'DA' => 'Producentgarantiens varighed i år',
        'DE' => 'Herstellergarantie in Jahren',
        'EL' => 'Εγγύηση παραγωγού σε έτη',
        'EN' => 'Producer guarantee in years',
        'ES' => 'Garantía del productor en años',
        'ET' => 'Tootja garantii aastates',
        'FI' => 'Tuottajan takuu vuosina',
        'FR' => 'Garantie du producteur en années',
        'GA' => 'Ráthaíocht an táirgeora de réir blianta',
        'HR' => 'Jamstvo proizvođača u godinama',
        'HU' => 'Gyártói jótállás években',
        'IT' => 'Garanzia del produttore in anni',
        'LT' => 'Gamintojo garantija metais',
        'LV' => 'Ražotāja garantija gados',
        'MT' => 'Garanzija tal-produttur fi snin',
        'NL' => 'Producentengarantie in jaren',
        'PL' => 'Gwarancja producenta w latach',
        'PT' => 'Garantia do produtor em anos',
        'RO' => 'Garanția producătorului în ani',
        'SK' => 'Záruka výrobcu v rokoch',
        'SL' => 'Garancija proizvajalca v letih',
        'SV' => 'Tillverkarens garanti i antal år',
    ];

    /**
     * Language code => wording.
     *
     * @return array<string, string>
     */
    public function getFooterEntries(): array
    {
        return self::ENTRIES;
    }

    /**
     * @return string[]
     */
    public function getFooterLines(): array
    {
        $lines = [];
        foreach (self::ENTRIES as $code => $text) {
            $lines[] = $code . ' ' . $text;
        }

        return $lines;
    }

    /**
     * All entries as one running text, separated by pipes, as on the artwork.
     */
    public function getFooterHtml(): string
    {
        return implode(' | ', $this->getFooterLines());
    }
}
