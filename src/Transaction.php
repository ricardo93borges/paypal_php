<?php

namespace easyPaypal;

class Transaction extends Request
{
    private $id;
    private $txnId;
    private $txnType;
    private $paymentStatus;
    private $pendingReason;
    private $reasonCode;
    private $custom;
    private $invoice;
    private $payerId;
    private $currency;
    private $gross;
    private $fee;
    private $handling;
    private $shipping;
    private $tax;
    private $request;

    /**
     * Transaction constructor.
     * @param $id
     * @param $txnId
     * @param $txnType
     * @param $paymentStatus
     * @param $pendingReason
     * @param $reasonCode
     * @param $custom
     * @param $invoice
     * @param $payerId
     * @param $currency
     * @param $gross
     * @param $fee
     * @param $handling
     * @param $shipping
     * @param $tax
     */
    public function __construct($id, $txnId, $txnType, $paymentStatus, $pendingReason, $reasonCode, $custom, $invoice, $payerId, $currency, $gross, $fee, $handling, $shipping, $tax, $request=null)
    {
        $this->id = $id;
        $this->txnId = $txnId;
        $this->txnType = $txnType;
        $this->paymentStatus = $paymentStatus;
        $this->pendingReason = $pendingReason;
        $this->reasonCode = $reasonCode;
        $this->custom = $custom;
        $this->invoice = $invoice;
        $this->payerId = $payerId;
        $this->currency = $currency;
        $this->gross = $gross;
        $this->fee = $fee;
        $this->handling = $handling;
        $this->shipping = $shipping;
        $this->tax = $tax;
        $this->request = null;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTxnId()
    {
        return $this->txnId;
    }

    /**
     * @param mixed $txnId
     */
    public function setTxnId($txnId)
    {
        $this->txnId = $txnId;
    }

    /**
     * @return mixed
     */
    public function getTxnType()
    {
        return $this->txnType;
    }

    /**
     * @param mixed $txnType
     */
    public function setTxnType($txnType)
    {
        $this->txnType = $txnType;
    }

    /**
     * @return mixed
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param mixed $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return mixed
     */
    public function getPendingReason()
    {
        return $this->pendingReason;
    }

    /**
     * @param mixed $pendingReason
     */
    public function setPendingReason($pendingReason)
    {
        $this->pendingReason = $pendingReason;
    }

    /**
     * @return mixed
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @param mixed $reasonCode
     */
    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = $reasonCode;
    }

    /**
     * @return mixed
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @param mixed $custom
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
    }

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return mixed
     */
    public function getPayerId()
    {
        return $this->payerId;
    }

    /**
     * @param mixed $payerId
     */
    public function setPayerId($payerId)
    {
        $this->payerId = $payerId;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getGross()
    {
        return $this->gross;
    }

    /**
     * @param mixed $gross
     */
    public function setGross($gross)
    {
        $this->gross = $gross;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
    }

    /**
     * @return mixed
     */
    public function getHandling()
    {
        return $this->handling;
    }

    /**
     * @param mixed $handling
     */
    public function setHandling($handling)
    {
        $this->handling = $handling;
    }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest()
    {

        if(!is_array($sellers)){
            $sellers = array($sellers);
        }

        $this->request = array(
            'USER' => $this->getUser(),
            'PWD' => $this->getPassword(),
            'SIGNATURE' => $this->getSignature(),
            'VERSION' => $this->getVersion(),
            'METHOD'=> $this->getMethod(),
            'RETURNURL' => $this->getReturnUrl(),
            'CANCELURL' => $this->getCancelUrl(),
            'BUTTONSOURCE' => $this->getButtonSource()
        );

        /*
        if($this->getNotifyUrl()){
            $this->request['NOTIFYURL'] = $this->getNotifyUrl();
        }*/

        $countSeller = 0;
        $countItem = 0;
        foreach($sellers as $seller){
            $this->request['PAYMENTREQUEST_'.$countSeller.'_PAYMENTACTION'] = $seller->getPaymentAction();
            $this->request['PAYMENTREQUEST_'.$countSeller.'_AMT'] = $seller->getAmount();
            $this->request['PAYMENTREQUEST_'.$countSeller.'_CURRENCYCODE'] = $seller->getCurrencyCode();
            $this->request['PAYMENTREQUEST_'.$countSeller.'_ITEMAMT'] = $seller->getItemAmount();
            $this->request['PAYMENTREQUEST_'.$countSeller.'_INVNUM'] = $seller->getReference();

            foreach($seller->getItems() as $item){
                $this->request['L_PAYMENTREQUEST_'.$countSeller.'_NAME'.$countItem] = $item->getName();
                $this->request['L_PAYMENTREQUEST_'.$countSeller.'_DESC'.$countItem] = $item->getDescription();
                $this->request['L_PAYMENTREQUEST_'.$countSeller.'_AMT'.$countItem] = $item->getAmount();
                $this->request['L_PAYMENTREQUEST_'.$countSeller.'_QTY'.$countItem] = $item->getQuantity();
                $countItem++;
            }
            $countSeller++;
        }

    }


}