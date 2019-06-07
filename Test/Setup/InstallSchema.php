<?php

namespace Sooryen\Test\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){
          $table = $installer->getConnection()->newTable(
          $installer->getTable('sooryen_test')
        )
          ->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
              'identity' => true,
              'nullable' => false,
              'primary'  => true,
              'unsigned' => true,
            ],
            'ID'
          )
          ->addColumn(
            'order_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            1,
            [],
            'Order ID'
          )
          ->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            1,
            [],
            'Customer ID'
          )
          ->addColumn(
            'last_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '255',
            [],
            'Last Name'
          )
          ->addColumn(
            'first_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '255',
            [],
            'First Name'
          )
          ->addColumn(
            'sku',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            1,
            [],
            'SKU'
          )
          ->addColumn(
            'qty',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            1,
            [],
            'Quantity'
          )
          ->addColumn(
            'product_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '255',
            [],
            'Product Name'
          );
        $installer->getConnection()->createTable($table);
		}
        $installer->endSetup();
    }
}
