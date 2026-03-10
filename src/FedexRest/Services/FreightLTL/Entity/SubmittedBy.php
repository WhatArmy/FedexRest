<?php

namespace FedexRest\Services\FreightLTL\Entity;

class SubmittedBy
{
    protected ?string $companyName = null;
    protected ?string $personName = null;
    protected ?string $phoneNumber = null;
    protected ?string $phoneExtension = null;
    protected ?string $emailAddress = null;

    
    /**
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName(?string $companyName): SubmittedBy
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @param string $personName
     * @return $this
     */
    public function setPersonName(?string $personName): SubmittedBy
    {
        $this->personName = $personName;
        return $this;
    }

    /**
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(?string $phoneNumber): SubmittedBy
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @param string $phoneExtension
     * @return $this
     */
    public function setPhoneExtension(?string $phoneExtension): SubmittedBy
    {
        $this->phoneExtension = $phoneExtension;
        return $this;
    }

    /**
     * @param string $emailAddress
     * @return $this
     */
    public function setEmailAddress(?string $emailAddress): SubmittedBy
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];

        if (!empty($this->companyName)) {
            $data['companyName'] = $this->companyName;
        }

        if (!empty($this->personName)) {
            $data['personName'] = $this->personName;
        }

        if (!empty($this->phoneNumber)) {
            $data['phoneNumber'] = $this->phoneNumber;
        }

        if (!empty($this->phoneExtension)) {
            $data['phoneExtension'] = $this->phoneExtension;
        }

        if (!empty($this->emailAddress)) {
            $data['emailAddress'] = $this->emailAddress;
        }

        return $data;
    }
}
