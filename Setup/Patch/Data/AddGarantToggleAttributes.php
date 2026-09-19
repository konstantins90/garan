<?php

declare(strict_types=1);

namespace Smetana\Garant\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Source\Boolean;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Per product switches for both marks, defaulting to the store configuration.
 */
class AddGarantToggleAttributes implements DataPatchInterface
{
    private const GROUP_NAME = 'EU-Garantie';

    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly CategorySetupFactory $categorySetupFactory
    ) {
    }

    public function apply(): self
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $setup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);
        $entityTypeId = $setup->getEntityTypeId(Product::ENTITY);

        $attributes = [
            'garant_notice_enabled' => [
                'label' => 'Gewährleistungshinweis anzeigen',
                'note' => 'Aus der Konfiguration = Einstellung des Stores. Nein blendet die Mitteilung für dieses Produkt aus.',
            ],
            'garant_label_enabled' => [
                'label' => 'GARAN-Label anzeigen',
                'note' => 'Aus der Konfiguration = Einstellung des Stores. Nein blendet die Kennzeichnung für dieses Produkt aus.',
            ],
        ];

        foreach ($attributes as $code => $config) {
            if ($setup->getAttribute(Product::ENTITY, $code)) {
                continue;
            }

            $setup->addAttribute(
                Product::ENTITY,
                $code,
                [
                    'type' => 'int',
                    'label' => $config['label'],
                    'input' => 'select',
                    'source' => Boolean::class,
                    'default' => Boolean::VALUE_USE_CONFIG,
                    'required' => false,
                    'sort_order' => 100,
                    'global' => ScopedAttributeInterface::SCOPE_STORE,
                    'visible' => true,
                    'user_defined' => true,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => '',
                    'note' => $config['note'],
                    'group' => self::GROUP_NAME,
                ]
            );
        }

        foreach ($setup->getAllAttributeSetIds($entityTypeId) as $attributeSetId) {
            $groupId = $setup->getAttributeGroupId($entityTypeId, $attributeSetId, self::GROUP_NAME);
            if (!$groupId) {
                continue;
            }

            foreach (array_keys($attributes) as $sortOrder => $code) {
                $attributeId = $setup->getAttributeId($entityTypeId, $code);
                if (!$attributeId) {
                    continue;
                }
                $setup->addAttributeToGroup(
                    $entityTypeId,
                    $attributeSetId,
                    $groupId,
                    $attributeId,
                    ($sortOrder + 5) * 10
                );
            }
        }

        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }

    /**
     * @return string[]
     */
    public static function getDependencies(): array
    {
        return [AddGarantAttributes::class];
    }

    /**
     * @return string[]
     */
    public function getAliases(): array
    {
        return [];
    }
}
