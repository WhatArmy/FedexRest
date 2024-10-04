<?php

namespace FedexRest\Services\Pickup\Entity;

use FedexRest\Entity\Person;

class Contact extends Person
{
    protected ?string $phoneExtension = null;

    /**
     * @return string|null
     */
    public function getPhoneExtension(): ?string
    {
        return $this->phoneExtension;
    }

    /**
     * @param string|null $phoneExtension
     * @return Contact
     */
    public function setPhoneExtension(?string $phoneExtension): Contact
    {
        $this->phoneExtension = $phoneExtension;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->personName)) {
            $data['personName'] = $this->personName;
        }
        if (!empty($this->phoneNumber)) {
            $data['phoneNumber'] = $this->phoneNumber;
        }
        if (!empty($this->companyName)) {
            $data['companyName'] = $this->companyName;
        }
        return $data;
    }
}