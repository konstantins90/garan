<?php

declare(strict_types=1);

namespace Smetana\Garant\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddGarantAttributes implements DataPatchInterface
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
            'garant_duration' => [
                'type' => 'decimal',
                'label' => 'Garantiedauer (Jahre)',
                'input' => 'text',
                'note' => 'Volle Jahre, bei Bedarf x,5. Minimum 2,5. Die Kennzeichnung erscheint nur bei mehr als zwei Jahren.',
            ],
            'garant_brand' => [
                'type' => 'varchar',
                'label' => 'Hersteller / Marke',
                'input' => 'text',
                'note' => 'Name des Herstellers, der die gewerbliche Haltbarkeitsgarantie gewährt.',
            ],
            'garant_model_id' => [
                'type' => 'varchar',
                'label' => 'Modellkennung (z. B. GTIN-13)',
                'input' => 'text',
                'note' => 'Modellkennung, für die der Hersteller die gewerbliche Haltbarkeitsgarantie gewährt.',
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
                    'type' => $config['type'],
                    'label' => $config['label'],
                    'input' => $config['input'],
                    'required' => false,
                    'sort_order' => 100,
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
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
            $setup->addAttributeGroup($entityTypeId, $attributeSetId, self::GROUP_NAME, 90);
            $groupId = $setup->getAttributeGroupId($entityTypeId, $attributeSetId, self::GROUP_NAME);

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
                    ($sortOrder + 1) * 10
                );
            }
        }

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
