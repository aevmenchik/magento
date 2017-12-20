<?php

/**
 * Adminhtml sales order create shipping insurance form block
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Block_Adminhtml_Order_Create_Insurance_Form extends Mage_Adminhtml_Block_Sales_Order_Create_Shipping_Method_Form
{
    protected $_rate;


    /**
     * Shipping_Insurance_Block_Adminhtml_Order_Create_Insurance_Form constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('order_create_insurance_form');
    }


    /**
     * Retrieve array of shipping insurance rate
     *
     * @return array
     */
    public function getShippingInsuranceRate()
    {
        if (is_null($this->_rate)) {
            $this->_rate = array();

            $shipping_method = $this->getCreateOrderModel()->getShippingAddress()->getShippingMethod();
            $subtotal = $this->getCreateOrderModel()->getShippingAddress()->getSubtotal();
            $insurance_active = $this->getCreateOrderModel()->getShippingAddress()->getShippingInsurance();

            /** @var $request Shipping_Insurance_Model_Insurance */
            $insurance = Mage::getModel('shipping_insurance/insurance');
            $insurance_rate = $insurance->getAvailableInsuranceRate($shipping_method, $subtotal);

            if (!empty($insurance_rate)) {
                $this->_rate = $insurance_rate;
                $this->_rate['checked'] = $insurance_active;
                $this->_rate['active_value'] = $insurance_active ? $insurance_rate['format_value'] : $this->getQuote()->getStore()->convertPrice(0, true);
            }
        }

        return $this->_rate;
    }


}
