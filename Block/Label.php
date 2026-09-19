<?php

declare(strict_types=1);

namespace Smetana\Garant\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\Model\DisplayRules;
use Smetana\Garant\Model\Label\LabelData;
use Smetana\Garant\Model\ProductContext;
use Smetana\Garant\ViewModel\LabelViewModel;

class Label extends Template
{
    public function __construct(
        Context $context,
        private readonly LabelViewModel $labelViewModel,
        private readonly DisplayRules $displayRules,
        private readonly ProductContext $productContext,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->setData('view_model', $this->labelViewModel);
    }

    public function getViewModel(): LabelViewModel
    {
        return $this->labelViewModel;
    }

    public function getGarantArea(): string
    {
        return (string)($this->getData('garant_area') ?: Config::AREA_CART);
    }

    /**
     * Product of the line item, or of the current page when none is set.
     */
    public function getGarantProduct(): ?ProductInterface
    {
        return $this->productContext->resolve($this->getData('item'));
    }

    public function isGarantVisible(): bool
    {
        return $this->displayRules->isLabelVisible($this->getGarantArea(), $this->getGarantProduct());
    }

    public function getLabelData(): ?LabelData
    {
        if (!$this->isGarantVisible()) {
            return null;
        }

        return $this->labelViewModel->resolveProduct($this->getGarantProduct());
    }
}
