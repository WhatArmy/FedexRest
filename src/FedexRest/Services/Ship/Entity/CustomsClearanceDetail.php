<?php

namespace FedexRest\Services\Ship\Entity;

use FedexRest\Services\Ship\Entity\Commodities;
use FedexRest\Services\Ship\Entity\DutiesPayment;

class CustomsClearanceDetail
{
    public ?Commodities $commodities;
    public ?DutiesPayment $dutiesPayment;

    /**
     * @param  Commodities  $commodities
     * @return $this
     */
    public function setCommodities(?Commodities $commodities): CustomsClearanceDetail
    {
        $this->commodities = $commodities;
        return $this;
    }
    
    /**
     * @param  DutiesPayment $dutiesPayment
     * @return $this
     */
    public function setDutiesPayment(?DutiesPayment $dutiesPayment): CustomsClearanceDetail
    {
        $this->dutiesPayment = $dutiesPayment;
        return $this;
    }


    public function prepare(): array {
        $data = [];
        if (!empty($this->commodities)) {
            $data['commodities'] = (array($this->commodities->prepare()));
        }
        if (!empty($this->dutiesPayment)) {
            $data['dutiesPayment'] = ($this->dutiesPayment);
        }
        return $data;
    }


}
