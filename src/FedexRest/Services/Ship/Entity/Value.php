<?php

namespace FedexRest\Services\Ship\Entity;

class Value
{
    public ?string $currency;
    public ?float $amount;

    /**
     * @param  string  $currency
     * @return $this
     */
    public function setCurrency(string $currency): Value
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param  float  $amount
     * @return $this
     */
    public function setAmount(float $amount): Value
    {
        $this->amount = $amount;
        return $this;
    }

    public function prepare(): array {
        $data = [];
        if (!empty($this->amount)) {
            $data['amount'] = $this->amount;
        }
        if (!empty($this->currency)) {
            $data['currency'] = $this->currency;
        }
        return $data;
    }


}
