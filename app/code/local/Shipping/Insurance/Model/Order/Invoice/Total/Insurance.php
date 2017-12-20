<?php

/**
 * Order invoice shipping total calculation model
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_insurance_Model_Order_Invoice_Total_Insurance extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{

    /**
     * Collect invoice subtotal
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Shipping_insurance_Model_Order_Invoice_Total_Insurance
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $invoice->setShippingInsurance(Shipping_Insurance_Model_Insurance::DISABLED);
        $invoice->setShippingInsuranceAmount(0);
        $invoice->setBaseShippinginsuranceAmount(0);
        $orderShippingInsurance        = $invoice->getOrder()->getShippingInsurance();
        $orderShippingInsuranceAmount        = $invoice->getOrder()->getShippingInsuranceAmount();
        $baseOrderShippingInsuranceAmount    = $invoice->getOrder()->getBaseShippingInsuranceAmount();

        if ($orderShippingInsurance) {
            $invoice->setShippingInsurance($orderShippingInsurance);
            $invoice->setShippingInsuranceAmount($orderShippingInsuranceAmount);
            $invoice->setBaseShippingInsuranceAmount($baseOrderShippingInsuranceAmount);

            $invoice->setGrandTotal($invoice->getGrandTotal() + $orderShippingInsuranceAmount);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseOrderShippingInsuranceAmount);
        }
        return $this;
    }
}
