<?php

/**
 * Class Shipping_Insurance_Model_Quote_Address_Total_Insurance
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Model_Quote_Address_Total_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'shipping_insurance';


    /**
     * Collect totals process.
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Shipping_Insurance_Model_Quote_Address_Total_Insurance
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);

        if ($address->getAddressType() == Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING && $address->getShippingInsurance()) {
            $insurance_rate = Mage::getModel('shipping_insurance/insurance')->getAvailableInsuranceRate(
                $address->getShippingMethod(),
                $address->getSubtotal()
            );

            if (!empty($insurance_rate)) {
                $balance = $insurance_rate['value'];

                $address->setShippingInsuranceAmount($balance);
                $address->setBaseShippingInsuranceAmount($balance);

                $address->setGrandTotal($address->getGrandTotal() + $address->getShippingInsuranceAmount());
                $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseShippingInsuranceAmount());
            }
        }
    }


    /**
     * Fetch (Retrieve data as array)
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return array
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $address->getShippingInsuranceAmount();
        if ($amount != 0) {
            $title = Mage::helper('sales')->__('Shipping Insurance');
            $address->addTotal(array(
                'code' => $this->getCode(),
                'title' => $title,
                'value' => $amount,
            ));
        }
        return $this;
    }
}