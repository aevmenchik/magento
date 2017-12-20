<?php

/**
 * Class Shipping_Insurance_Block_Adminhtml_Order_Totals
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Block_Adminhtml_Order_Totals extends Mage_Adminhtml_Block_Sales_Order_Totals
{

    /**
     * Initialize order totals array
     *
     * @return Shipping_Insurance_Block_Adminhtml_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        if ($this->getTotal(Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING)
            && $this->getSource()->getShippingInsurance()) {

            $total = new Varien_Object(array(
                'code'  => 'shipping_insurance',
                'field' => 'shipping_insurance_amount',
                'value' => $this->getSource()->getShippingInsuranceAmount(),
                'label' => $this->__('Shipping Insurance')
            ));

            $this->addTotal($total, Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING);
        }

        return $this;
    }

}
