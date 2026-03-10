<?php

namespace FedexRest\Services\FreightLTL\Entity;

use FedexRest\Services\FreightLTL\Entity\Billing;
use FedexRest\Services\FreightLTL\Entity\SubmittedBy;
use FedexRest\Services\FreightLTL\Entity\FreightPickupLineItem;


class FreightPickupDetail
{
    protected ?string $accountNumber = null;
    protected ?string $accountNumberKey = null;
    protected ?string $role = null;
    protected ?string $payment = null;
    protected ?SubmittedBy $submittedBy = null;
    protected array $lineItems = [];
    protected ?Billing $alternateBilling = null;
    protected ?string $userMessage = null;


    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber(?string $accountNumber): freightPickupDetail
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @param string $accountNumberKey
     * @return $this
     */
    public function setAccountNumberKey(?string $accountNumberKey): freightPickupDetail
    {
        $this->accountNumberKey = $accountNumberKey;
        return $this;
    }

    /**
     * @param string $role
     * @return $this
     */
    public function setRole(?string $role): freightPickupDetail
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param string $payment
     * @return $this
     */
    public function setPayment(?string $payment): freightPickupDetail
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @param SubmittedBy $submittedBy
     * @return $this
     */
    public function setSubmittedBy(?SubmittedBy $submittedBy): freightPickupDetail
    {
        $this->submittedBy = $submittedBy;
        return $this;
    }

    /**
     * @param array $lineItems
     * @return $this
     */
    public function setLineItems(FreightPickupLineItem ...$lineItems): freightPickupDetail
    {
        $this->lineItems = $lineItems;
        return $this;
    }

    /**
     * @param Billing $alternateBilling
     * @return $this
     */
    public function setAlternateBilling(?Billing $alternateBilling): freightPickupDetail
    {
        $this->alternateBilling = $alternateBilling;
        return $this;
    }

    /**
     * @param string $userMessage
     * @return $this
     */
    public function setUserMessage(?string $userMessage): freightPickupDetail
    {
        $this->userMessage = $userMessage;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];

        if(!empty($this->accountNumber) || !empty($this->accountNumberKey)) {
            $data['accountNumber'] = [];
            
            if(!empty($this->accountNumber)) {
                $data['accountNumber']['value'] = $this->accountNumber;
            }

            if(!empty($this->accountNumberKey)) {
                $data['accountNumber']['key'] = $this->accountNumberKey;
            }
        }

        if(!empty($this->role)) {
            $data['role'] = $this->role;
        }

        if(!empty($this->payment)) {
            $data['payment'] = $this->payment;
        }

        if(!empty($this->submittedBy)) {
            $data['submittedBy'] = $this->submittedBy->prepare();
        }

        if(!empty($this->lineItems)) {
            $data['lineItems'] = array_map(function (FreightPickupLineItem $lineItem) {
                return $lineItem->prepare();
            }, $this->lineItems);
        }

        if(!empty($this->alternateBilling)) {
            $data['alternateBilling'] = $this->alternateBilling->prepare();
        }

        if(!empty($this->userMessage)) {
            $data['userMessage'] = $this->userMessage;
        }

        return $data;
    }


    



}
