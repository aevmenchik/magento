<?php

/**
 * Order invoice shipping total calculation model
 *
  * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_insurance_Model_Order_Creditmemo_Total_Insurance extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    /**
     * Collect credit memo subtotal
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return Shipping_insurance_Model_Order_Creditmemo_Total_Insurance
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $creditmemo->setShippingInsurance(Shipping_Insurance_Model_Insurance::DISABLED);
        $creditmemo->setShippingInsuranceAmount(0);
        $creditmemo->setBaseShippinginsuranceAmount(0);
        $orderShippingInsurance        = $creditmemo->getOrder()->getShippingInsurance();
        $orderShippingInsuranceAmount        = $creditmemo->getOrder()->getShippingInsuranceAmount();
        $baseOrderShippingInsuranceAmount    = $creditmemo->getOrder()->getBaseShippingInsuranceAmount();

        if ($orderShippingInsurance) {
            $creditmemo->setShippingInsurance($orderShippingInsurance);
            $creditmemo->setShippingInsuranceAmount($orderShippingInsuranceAmount);
            $creditmemo->setBaseShippingInsuranceAmount($baseOrderShippingInsuranceAmount);

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $orderShippingInsuranceAmount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseOrderShippingInsuranceAmount);
        }

        return $this;
    }

}