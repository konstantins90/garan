<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smetana\Garant\Model\Notice\NoticeAssets;

/**
 * Languages for which the notice artwork is delivered.
 */
class NoticeLanguage implements OptionSourceInterface
{
    private const NAMES = [
        'BG' => 'Bulgarian',
        'CS' => 'Czech',
        'DA' => 'Danish',
        'DE' => 'German',
        'EL' => 'Greek',
        'EN' => 'English',
        'ES' => 'Spanish',
        'ET' => 'Estonian',
        'FI' => 'Finnish',
        'FR' => 'French',
        'GA' => 'Irish',
        'HR' => 'Croatian',
        'HU' => 'Hungarian',
        'IT' => 'Italian',
        'LT' => 'Lithuanian',
        'LV' => 'Latvian',
        'MT' => 'Maltese',
        'NL' => 'Dutch',
        'PL' => 'Polish',
        'PT' => 'Portuguese',
        'RO' => 'Romanian',
        'SK' => 'Slovak',
        'SL' => 'Slovenian',
        'SV' => 'Swedish',
    ];

    public function __construct(private readonly NoticeAssets $noticeAssets)
    {
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function toOptionArray(): array
    {
        $options = [];
        foreach ($this->noticeAssets->getImageLanguages() as $code) {
            $options[] = [
                'value' => $code,
                'label' => isset(self::NAMES[$code]) ? $code . ' – ' . __(self::NAMES[$code]) : $code,
            ];
        }

        return $options;
    }
}
