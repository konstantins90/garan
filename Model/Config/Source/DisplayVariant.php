<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smetana\Garant\Helper\Config;

class DisplayVariant implements OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => Config::VARIANT_STANDARD, 'label' => __('Standard')],
            ['value' => Config::VARIANT_COMPACT, 'label' => __('Compact')],
        ];
    }
}
