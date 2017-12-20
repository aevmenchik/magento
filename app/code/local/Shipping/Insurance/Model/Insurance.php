<?php

/**
 * Class Shipping_Insurance_Model_Insurance
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Model_Insurance
{
    const ACTIVE = 1;
    const DISABLED = 0;

    /**
     * Part of carrier xml config path
     *
     * @var string
     */
    protected $_availabilityConfigField = 'active';

    /**
     * Insurance calculate fee value in carrier xml config path
     *
     * @var string
     */
    protected $_insuranceCalculateFeeConfigField = 'insurance_calculate_fee';

    /**
     * Insurance fee value in carrier xml config path
     *
     * @var string
     */
    protected $_insuranceFeeConfigField = 'insurance_fee';



    /**
     * Return calculated insurance rate for requested shipping method
     *
     * @param string $shipping_method
     *
     * @return bool
     */
    public function isAvailableInsurance($shipping_method)
    {
        $shipping_code = $this->_getShippingCode($shipping_method);
        $insurance = $this->_getInsuranceByCarrier($shipping_code);

        return !empty($insurance[$this->_insuranceFeeConfigField]);
    }


    /**
     * Return calculated insurance rate for requested shipping method
     *
     * @param string $carrier_code
     *
     * @return array
     */
    protected function _getInsuranceByCarrier($carrier_code)
    {
        $insurance = array();

        $carriers = $this->getAvailableCarriersWithInsurance();

        if (!empty($carriers[$carrier_code])) {
            $insurance = array_intersect_key(
                $carriers[$carrier_code],
                array_flip(array(
                    $this->_insuranceCalculateFeeConfigField,
                    $this->_insuranceFeeConfigField,
                ))
            );
        }

        return $insurance;
    }


    /**
     * Return calculated insurance rate for requested shipping method
     *
     * @param string $shipping_method
     * @param float $subtotal
     *
     * @return array
     */
    public function getAvailableInsuranceRate($shipping_method, $subtotal)
    {
        $insurance_rate = array();

        if (!empty($shipping_method)) {
            $shipping_code = $this->_getShippingCode($shipping_method);
            $insurance = $this->_getInsuranceByCarrier($shipping_code);

            if (!empty($insurance[$this->_insuranceFeeConfigField])) {
                if ($insurance[$this->_insuranceCalculateFeeConfigField] == Mage_Shipping_Model_Carrier_Abstract::HANDLING_TYPE_PERCENT) {
                    $rate = round($subtotal * (1 - $insurance[$this->_insuranceFeeConfigField] / 100), 2);
                } elseif ($insurance[$this->_insuranceCalculateFeeConfigField] == Mage_Shipping_Model_Carrier_Abstract::HANDLING_TYPE_FIXED) {
                    $rate = $insurance[$this->_insuranceFeeConfigField];
                }

                if (!empty($rate)) {
                    $insurance_rate = array(
                        'value' => $rate,
                        'format_value' => Mage::getSingleton('checkout/cart')->getQuote()->getStore()->convertPrice($rate, true),
                    );
                }
            }
        }

        return $insurance_rate;
    }

    /**
     * Return shipping code
     *
     * @return string
     */
    protected function _getShippingCode($shipping_method)
    {
        return array_shift(explode('_', $shipping_method));
    }



    /**
     * Return all active carriers with active insurance value
     *
     * @return array
     */
    public function getAvailableCarriersWithInsurance()
    {
        $carriers = Mage::getStoreConfig('carriers');

        $available_carriers_with_insurance = array();
        if (!empty($carriers)) {
            foreach ($carriers as $carrier_code => $carrier) {
                if (!empty($carrier[$this->_availabilityConfigField]) && !empty($carrier[$this->_insuranceFeeConfigField])) {
                    $available_carriers_with_insurance[$carrier_code] = $carrier;
                }
            }
        }

        return $available_carriers_with_insurance;
    }


}
