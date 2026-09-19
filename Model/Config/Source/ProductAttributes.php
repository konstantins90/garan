<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Config\Source;

use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class ProductAttributes implements OptionSourceInterface
{
    public function __construct(
        private readonly CollectionFactory $attributeCollectionFactory
    ) {
    }

    public function toOptionArray(): array
    {
        $options = [['value' => '', 'label' => __('-- Please Select --')]];
        $collection = $this->attributeCollectionFactory->create();
        $collection->addVisibleFilter();
        $collection->setOrder('frontend_label', 'ASC');

        foreach ($collection as $attribute) {
            $code = (string)$attribute->getAttributeCode();
            $label = (string)($attribute->getFrontendLabel() ?: $code);
            $options[] = [
                'value' => $code,
                'label' => sprintf('%s (%s)', $label, $code),
            ];
        }

        return $options;
    }
}
