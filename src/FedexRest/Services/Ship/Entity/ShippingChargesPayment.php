<?php

namespace FedexRest\Services\Ship\Entity;

class ShippingChargesPayment
{
    public ?string $paymentType;
    //TODO: Missing Payor Element <- Works without in most cases, but should be added in the future for 3rd party payor scenario.
    /**
     * @param string  $paymentType
     * @return $this
     */
    public function setPaymentType(string $paymentType): ShippingChargesPayment
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->paymentType)) {
            $data['paymentType'] = $this->paymentType;
        }
        return $data;
    }
}
