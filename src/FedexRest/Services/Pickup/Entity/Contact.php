<?php

namespace FedexRest\Services\Pickup\Entity;

class Contact
{
    protected ?string $personName = null;
    protected ?string $phoneNumber = null;
    protected ?string $companyName = null;
    protected ?string $phoneExtension = null;

    public function setPersonName(string $personName): Contact
    {
        $this->personName = $personName;
        return $this;
    }

    public function setPhoneNumber(string $phoneNumber): Contact
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function setCompanyName(string $companyName): Contact
    {
        $this->companyName = $companyName;
        return $this;
    }

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