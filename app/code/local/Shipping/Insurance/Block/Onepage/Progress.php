<?php

/**
 * Create shipping insurance block in Checkout progress section
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Block_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress
{

    /**
     * Return shipping insurance enable
     *
     * @return mixed
     */
    public function getShippingInsurance()
    {
        return $this->getQuote()->getShippingAddress()->getShippingInsurance();
    }


    /**
     * Return rate of shipping insurance in price format
     *
     * @return string
     */
    public function getShippingInsuranceValueFormat()
    {
        if ($this->getShippingInsurance()) {
            $insurance_rate = $this->getQuote()->getShippingAddress()->getShippingInsuranceAmount();
            $insurance_value_format = Mage::getSingleton('checkout/cart')->getQuote()->getStore()->convertPrice($insurance_rate, true);

            return $insurance_value_format;
        }


        return '';
    }



    /**
     * Get checkout steps codes
     *
     * @return array
     */
    protected function _getStepCodes()
    {
        return array('login', 'billing', 'shipping', 'shipping_method', 'shipping_insurance', 'payment', 'review');
    }


}
