<?php

declare(strict_types=1);

namespace Smetana\Garant\Model\Notice;

use Magento\Cms\Api\GetPageByIdentifierInterface;
use Magento\Cms\Helper\Page as CmsPageHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Smetana\Garant\Helper\Config;
use Smetana\Garant\Setup\Patch\Data\CreateNoticeCmsPage;

class NoticeUrl
{
    public function __construct(
        private readonly Config $config,
        private readonly CmsPageHelper $cmsPageHelper,
        private readonly GetPageByIdentifierInterface $getPageByIdentifier,
        private readonly StoreManagerInterface $storeManager,
        private readonly UrlInterface $urlBuilder
    ) {
    }

    public function getUrl(): string
    {
        $value = $this->config->getNoticeCmsPage();
        if ($value === '') {
            $value = CreateNoticeCmsPage::IDENTIFIER;
        }

        if (ctype_digit($value)) {
            $url = $this->cmsPageHelper->getPageUrl($value);
            return $url ?: $this->urlBuilder->getUrl(CreateNoticeCmsPage::IDENTIFIER);
        }

        try {
            $storeId = (int)$this->storeManager->getStore()->getId();
            $page = $this->getPageByIdentifier->execute($value, $storeId);
            $url = $this->cmsPageHelper->getPageUrl((string)$page->getId());
            if ($url) {
                return $url;
            }
        } catch (NoSuchEntityException) {
            // Fall through to identifier URL.
        }

        return $this->urlBuilder->getUrl(null, ['_direct' => $value]);
    }
}
