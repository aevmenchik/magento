<?php

/**
 * Class Shipping_Insurance_Model_Quote
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Model_Quote extends Mage_Sales_Model_Quote
{
    const TYPE_SHIPPING_INSURANCE = 'shipping_insurance';


    /**
     * retrieve quote shipping address
     *
     * @return Mage_Sales_Model_Quote_Address
     */
    public function getShippingInsuranceAddress()
    {
        return $this->_getAddressByType(Shipping_Insurance_Model_Quote::TYPE_SHIPPING_INSURANCE);
    }

}