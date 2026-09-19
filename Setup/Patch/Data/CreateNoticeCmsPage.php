<?php

declare(strict_types=1);

namespace Smetana\Garant\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Cms\Model\ResourceModel\Page as PageResource;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\Store;

class CreateNoticeCmsPage implements DataPatchInterface
{
    public const IDENTIFIER = 'gesetzliche-gewaehrleistung';

    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly PageFactory $pageFactory,
        private readonly PageResource $pageResource
    ) {
    }

    public function apply(): self
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $page = $this->pageFactory->create();
        $this->pageResource->load($page, self::IDENTIFIER, 'identifier');
        if ($page->getId()) {
            $this->moduleDataSetup->getConnection()->endSetup();
            return $this;
        }

        $page->setTitle('Gesetzliche Gewährleistung');
        $page->setIdentifier(self::IDENTIFIER);
        $page->setIsActive(true);
        $page->setPageLayout('1column');
        $page->setContentHeading('Gesetzliche Gewährleistung');
        $page->setContent(
            '{{block class="Smetana\\Garant\\Block\\Notice" template="Smetana_Garant::notice/full.phtml"}}'
        );
        $page->setData('stores', [Store::DEFAULT_STORE_ID]);
        $this->pageResource->save($page);

        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
