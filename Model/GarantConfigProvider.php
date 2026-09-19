<?php

declare(strict_types=1);

namespace Smetana\Garant\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\LayoutInterface;
use Smetana\Garant\Block\Notice;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\ViewModel\NoticeViewModel;

class GarantConfigProvider implements ConfigProviderInterface
{
    public function __construct(
        private readonly Config $config,
        private readonly NoticeViewModel $noticeViewModel,
        private readonly LayoutInterface $layout
    ) {
    }

    public function getConfig(): array
    {
        $noticeVisible = $this->config->isNoticeVisibleOn(Config::AREA_CHECKOUT);

        if (!$noticeVisible && !$this->config->isLabelVisibleOn(Config::AREA_CHECKOUT)) {
            return [];
        }

        return [
            'smetanaGarant' => [
                'notice' => [
                    'enabled' => $noticeVisible,
                    'url' => $this->noticeViewModel->getFullPageUrl(),
                    'linkLabel' => $this->noticeViewModel->getLinkLabel(),
                    'title' => $this->noticeViewModel->getText('title'),
                    'html' => $noticeVisible ? $this->renderNotice() : '',
                    'panelHtml' => $noticeVisible ? $this->renderPanel() : '',
                ],
                'label' => [
                    'enabled' => $this->config->isLabelVisibleOn(Config::AREA_CHECKOUT),
                ],
            ],
        ];
    }

    /**
     * Line items in the checkout only carry the compact notice.
     */
    private function renderNotice(): string
    {
        return $this->renderBlock('Smetana_Garant::notice/compact.phtml');
    }

    /**
     * Collapsed panel below the payment methods.
     */
    private function renderPanel(): string
    {
        return $this->renderBlock('Smetana_Garant::notice/panel.phtml');
    }

    private function renderBlock(string $template): string
    {
        /** @var Notice $block */
        $block = $this->layout->createBlock(Notice::class);
        $block->setTemplate($template);
        $block->setData('garant_area', Config::AREA_CHECKOUT);

        return $block->toHtml();
    }
}
