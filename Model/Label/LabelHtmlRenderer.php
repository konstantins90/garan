<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Label;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\LayoutInterface;
use Smetana\Garant\ViewModel\LabelViewModel;

class LabelHtmlRenderer
{
    public function __construct(
        private readonly LabelViewModel $labelViewModel,
        private readonly LayoutInterface $layout
    ) {
    }

    /**
     * Line items in the checkout only carry the compact artwork.
     */
    public function render(LabelData $labelData): string
    {
        /** @var Template $block */
        $block = $this->layout->createBlock(Template::class);
        $block->setTemplate('Smetana_Garant::label/badge.phtml');
        $block->setData('label_data', $labelData);
        $block->setData('view_model', $this->labelViewModel);

        return $block->toHtml();
    }
}
