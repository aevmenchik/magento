<?php

/**
 * Class Shipping_Insurance_Block_Onepage
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */

class Shipping_Insurance_Block_Onepage extends Mage_Checkout_Block_Onepage
{

    /**
     * Get 'one step checkout' step data
     *
     * @return array
     */
    public function getSteps()
    {
        $steps = array();

        if (!$this->isCustomerLoggedIn()) {
            $steps['login'] = $this->getCheckout()->getStepData('login');
        }

        $stepCodes = array('billing', 'shipping', 'shipping_method', 'shipping_insurance', 'payment', 'review');

        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }

        return $steps;
    }
}