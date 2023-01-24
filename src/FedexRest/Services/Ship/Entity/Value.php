<?php

namespace FedexRest\Services\Ship\Entity;

class Value
{
    public ?string $currency;
    public ?int $amount;

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
     * @param  int  $amount
     * @return $this
     */
    public function setAmount(int $amount): Value
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
