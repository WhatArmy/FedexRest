<?php

namespace FedexRest\Services\FreightLTL\Entity;

use FedexRest\Entity\Address;
use FedexRest\Services\Pickup\Entity\Contact;

class Billing
{
    protected ?Address $address = null;
    protected ?Contact $contact = null;
    protected ?string $accountNumber = null;

    /**
     * @param Address $address
     * @return $this
     */
    public function setAddress(?Address $address): Billing
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param Contact $contact
     * @return $this
     */
    public function setContact(?Contact $contact): Billing
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber(?string $accountNumber): Billing
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @return array[]
     */
    public function prepare(): array
    {
        $data = [];

        if (!empty($this->address)) {
            $data['address'] = $this->address->prepare();
        }

        if (!empty($this->contact)) {
            $data['contact'] = $this->contact->prepare();
        }

        if (!empty($this->accountNumber)) {
            $data['accountNumber'] = $this->accountNumber;
        }

        return $data;
    }

}
