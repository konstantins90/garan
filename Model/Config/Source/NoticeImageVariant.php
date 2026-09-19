<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smetana\Garant\Model\Notice\NoticeAssets;

/**
 * Colour or black and white print of the notice artwork.
 */
class NoticeImageVariant implements OptionSourceInterface
{
    /**
     * @return array<int, array{value: string, label: string}>
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => NoticeAssets::VARIANT_COLOR, 'label' => __('Colour')],
            ['value' => NoticeAssets::VARIANT_BW, 'label' => __('Black and white')],
        ];
    }
}
