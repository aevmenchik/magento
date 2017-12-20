<?php


/**
 * Order create model
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Model_Adminhtml_Sales_Order_Create extends Mage_Adminhtml_Model_Sales_Order_Create
{

    /**
     * Parse data retrieved from request
     *
     * @param   array $data
     * @return  Shipping_Insurance_Model_Adminhtml_Sales_Order_Create
     */
    public function importPostData($data)
    {
        if (isset($data['shipping_method'])) {
            $this->getShippingAddress()->setShippingInsurance(Shipping_Insurance_Model_Insurance::DISABLED);
        }

        if (isset($data['shipping_insurance'])) {
            if (!empty($data['shipping_insurance'])) {
                $shipping_method = $this->getShippingAddress()->getShippingMethod();
                $subtotal = $this->getShippingAddress()->getSubtotal();

                /** @var $request Shipping_Insurance_Model_Insurance */
                $insurance = Mage::getModel('shipping_insurance/insurance');
                $insurance_rate = $insurance->getAvailableInsuranceRate($shipping_method, $subtotal);

                if (!empty($insurance_rate)) {
                    $insurance_active = true;
                    $this->getShippingAddress()->setShippingInsurance(Shipping_Insurance_Model_Insurance::ACTIVE);
                    $this->getShippingAddress()->setShippingInsuranceAmount($insurance_rate['value']);
                    $this->getShippingAddress()->setBaseShippingInsuranceAmount($insurance_rate['value']);
                }
            }

            if (empty($insurance_active)) {
                $this->getShippingAddress()->setShippingInsurance(Shipping_Insurance_Model_Insurance::DISABLED);
            }
        }

        return parent::importPostData($data);
    }

}