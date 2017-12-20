<?php

/**
 * Adminhtml sales order create shipping insurance block
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Block_Adminhtml_Order_Create_Insurance extends Mage_Adminhtml_Block_Sales_Order_Create_Shipping_Method
{

    /**
     * Shipping_Insurance_Block_Adminhtml_Order_Create_Insurance constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('insurance_order_create_insurance');
    }

    /**
     * Return header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('sales')->__('Shipping Insurance');
    }

    /**
     * Return header css class
     *
     * @return string
     */
    public function getHeaderCssClass()
    {
        return 'head-shipping-insurance';
    }
}
