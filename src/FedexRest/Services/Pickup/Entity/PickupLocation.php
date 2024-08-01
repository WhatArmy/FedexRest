<?php

namespace FedexRest\Services\Pickup\Entity;

use FedexRest\Entity\Address;

class PickupLocation
{
    protected Contact $contact;
    protected Address $address;
    protected ?string $accountNumber = null;
    protected ?string $deliveryInstructions = null;

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return PickupLocation
     */
    public function setContact(Contact $contact): PickupLocation
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return PickupLocation
     */
    public function setAddress(Address $address): PickupLocation
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    /**
     * @param string|null $accountNumber
     * @return PickupLocation
     */
    public function setAccountNumber(?string $accountNumber): PickupLocation
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeliveryInstructions(): ?string
    {
        return $this->deliveryInstructions;
    }

    /**
     * @param string|null $deliveryInstructions
     * @return PickupLocation
     */
    public function setDeliveryInstructions(?string $deliveryInstructions): PickupLocation
    {
        $this->deliveryInstructions = $deliveryInstructions;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'contact' => $this->contact->prepare(),
            'address' => $this->address->prepare(),
        ];
        if (!empty($accountNumber)) {
            $data['accountNumber'] = $accountNumber;
        }
        if (!empty($deliveryInstructions)) {
            $data['deliveryInstructions'] = $deliveryInstructions;
        }
        return $data;
    }
}