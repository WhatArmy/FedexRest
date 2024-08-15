<?php

namespace FedexRest\Services\Ship\Entity;

use FedexRest\Services\Ship\Type\PaymentType;

class DutiesPayment
{
    public ?PaymentType $paymentType;
    public string $payor;
    
    /**
     * @param PaymentType $paymentType
     * @return $this
     */
    public function setPaymentType(?PaymentType $paymentType): DutiesPayment
    {
        $this->paymentType = $paymentType;
        return $this;
    }
    
    /**
     * @param  array $payor
     * @return $this
     */
    public function setPayor(string $payor = NULL): DutiesPayment
    {
        $this->payor = array('responsibleParty'=>$payor);
        return $this;
    }
    
    public function prepare(): array {
        $data = [];
        if (!empty($this->paymentType)) {
            $data['paymentType'] = ($this->paymentType);
        }
        if (!empty($this->payor)) {
            $data['payor'] = ($this->payor);
        }   
        return $data;
    }


}