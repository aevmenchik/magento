<?php

/**
 * Class Shipping_Insurance_Model_Total_Insurance
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Model_Total_Insurance extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    /**
     * Shipping_Insurance_Model_Total_Insurance constructor
     */
    public function __construct()
    {
        $this->setCode('shipping_insurance');
    }


    /**
     * Collect totals information about shipping insurance
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  Shipping_Insurance_Model_Total_Insurance
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0)
            ->_setBaseAmount(0);

        $address->collectShippingRates();

        $this->_setAmount(0)
            ->_setBaseAmount(0);

        $insurance = $address->getShippingInsuranceAmount();
        if (!empty($insurance)) {
            $amountPrice = $address->getQuote()->getStore()->convertPrice($insurance, false);
            $this->_setAmount($insurance);
            $this->_setBaseAmount($insurance);
        }


        return $this;
    }


    /**
     * Add shipping totals information to address object
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  Shipping_Insurance_Model_Total_Insurance
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


    /**
     * Get Shipping label
     *
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('sales')->__('Shipping Insurance');
    }
}
