<?php

require_once 'Mage/Checkout/controllers/OnepageController.php';

/**
 * Class Shipping_Insurance_OnepageController
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_OnepageController extends Mage_Checkout_OnepageController
{

    /**
     * Shipping insurance save action
     */
    public function saveShippingMethodAction()
    {
        if ($this->_expireAjax()) {
            return;
        }

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('shipping_method', '');
            $result = $this->getOnepage()->saveShippingMethod($data);
            /* $result will have erro data if shipping method is empty */
            if(!$result) {
                Mage::dispatchEvent('checkout_controller_onepage_save_shipping_method',
                    array('request'=>$this->getRequest(),
                        'quote'=>$this->getOnepage()->getQuote()));
                $this->getOnepage()->getQuote()->collectTotals();
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));

                $result['goto_section'] = 'shipping_insurance';
                $result['update_section'] = array(
                    'name' => 'shipping_insurance',
                    'html' => $this->_getShippingInsuranceHtml()
                );
            }
            $this->getOnepage()->getQuote()->collectTotals()->save();
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }


    /**
     * Get shipping insurance step html
     *
     * @return string
     */
    protected function _getShippingInsuranceHtml()
    {
        $layout = $this->getLayout();
        $update = $layout->getUpdate();
        $update->load('shipping_insurance');
        $layout->generateXml();
        $layout->generateBlocks();
        $output = $layout->getOutput();
        return $output;
    }


    /**
     * Shipping insurance save action
     */
    public function saveInsuranceAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $insurance = $this->getRequest()->getPost('shipping_insurance');

            $result = array();
            if ($insurance) {
                Mage::getSingleton('checkout/cart')->getQuote()->getShippingAddress()
                    ->setShippingInsurance(Shipping_Insurance_Model_Insurance::ACTIVE)
                    ->setShippingInsuranceAmount($insurance)
                    ->setBaseShippingInsuranceAmount($insurance)
                    ->save();
            } else {
                Mage::getSingleton('checkout/cart')->getQuote()->getShippingAddress()
                    ->setShippingInsurance(Shipping_Insurance_Model_Insurance::DISABLED)
                    ->save();
            }
            Mage::getSingleton('checkout/session')->setStepData(Shipping_Insurance_Model_Quote::TYPE_SHIPPING_INSURANCE, 'complete', true);

            if (!isset($result['error'])) {
                /* check quote for virtual */
                $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}