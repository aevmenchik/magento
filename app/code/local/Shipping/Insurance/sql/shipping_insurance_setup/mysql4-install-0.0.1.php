<?php

/* @var $this Mage_Sales_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$sql = "SELECT entity_type_id FROM ".$this->getTable('eav_entity_type')." WHERE entity_type_code='order'";
$row = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchRow($sql);
$attribute  = array(
    'type'			=> 'text',
    'label'			=> 'Insurance',
    'visible'		=> false,
    'required'		=> false,
    'user_defined'	=> false,
    'searchable'	=> false,
    'filterable'	=> false,
    'comparable'	=> false,
);
$installer->addAttribute($row['entity_type_id'], 'shipping_insurance', $attribute);


$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'),'shipping_insurance', array(
    'type'     => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable' => false,
    'default'  => '0',
    'comment'  => 'Shipping insurance add to order',
));
$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'),'shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Shipping insurance amount',
));
$installer->getConnection()->addColumn($installer->getTable('sales/quote_address'),'base_shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Base shipping insurance amount',
));


$installer->getConnection()->addColumn($installer->getTable('sales/order'),'shipping_insurance', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable'  => false,
    'default'   => '0',
    'comment'   => 'Shipping insurance add to order',
));
$installer->getConnection()->addColumn($installer->getTable('sales/order'),'shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Shipping insurance amount',
));
$installer->getConnection()->addColumn($installer->getTable('sales/order'),'base_shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Base shipping insurance amount',
));


$installer->getConnection()->addColumn($installer->getTable('sales/order_address'),'shipping_insurance', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable'  => false,
    'default'   => '0',
    'comment'   => 'Shipping insurance add to order',
));


$installer->getConnection()->addColumn($installer->getTable('sales/invoice'),'shipping_insurance', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable'  => false,
    'default'   => '0',
    'comment'   => 'Shipping insurance add to order',
));
$installer->getConnection()->addColumn($installer->getTable('sales/invoice'),'shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Shipping insurance amount',
));
$installer->getConnection()->addColumn($installer->getTable('sales/invoice'),'base_shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Base shipping insurance amount',
));


$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo'),'shipping_insurance', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
    'nullable'  => false,
    'default'   => '0',
    'comment'   => 'Shipping insurance add to order',
));
$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo'),'shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Shipping insurance amount',
));
$installer->getConnection()->addColumn($installer->getTable('sales/creditmemo'),'base_shipping_insurance_amount', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'scale'     => 2,
    'precision' => 10,
    'nullable'  => false,
    'comment'   => 'Base shipping insurance amount',
));


$installer->endSetup();

