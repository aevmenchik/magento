<?php
/**
 * Types of shipping insurance calculation
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Model_Source_CalculateType
{

    /**
     * Return options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => Mage_Shipping_Model_Carrier_Abstract::HANDLING_TYPE_FIXED, 'label' => Mage::helper('shipping')->__('Fixed')),
            array('value' => Mage_Shipping_Model_Carrier_Abstract::HANDLING_TYPE_PERCENT, 'label' => Mage::helper('shipping')->__('Percent')),
        );
    }
}