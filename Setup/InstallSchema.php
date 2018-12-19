<?php

namespace Maximuspoder\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /** @var string  */
    const BANNERS = 'maximuspoder_banners';

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::BANNERS))
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Banner id')
            ->addColumn(
                'image',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Banner Image')
            ->addColumn(
                'content',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'HTML content')
            ->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'nullable' => false,
                    'default' => '1'
                ],
                'Status')
            ->addIndex(
                $setup->getIdxName(
                    self::BANNERS, ['id',],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                ),
                ['id',],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE])
            ->setComment('Banner table');

        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}