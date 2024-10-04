<?php

namespace FedexRest\Services\Pickup\Entity;

class EmailAddress
{
    protected string $address;
    protected ?string $locale = null;

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): EmailAddress
    {
        $this->address = $address;
        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): EmailAddress
    {
        $this->locale = $locale;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'address' => $this->address
        ];
        if (!empty($this->locale)) {
            $data['locale'] = $this->locale;
        }
        return $data;
    }
}
