<?php

namespace FedexRest\Services\FreightLTL\Entity;

class FreightDirectDataDetails
{
    protected ?string $type = null;
    protected ?string $transportationType = null;
    protected ?string $emailAddress = null;
    protected ?array $phoneNumberDetails = [];
    
    /**
     * @param string|null $type
     * @return FreightDirectDetail
     */
    public function setType(?string $type): FreightDirectDataDetails
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string|null $transportationType
     * @return FreightDirectDetail
     */
    public function setTransportationType(?string $transportationType): FreightDirectDataDetails
    {
        $this->transportationType = $transportationType;
        return $this;
    }

    /**
     * @param string|null $emailAddress
     * @return FreightDirectDetail
     */
    public function setEmailAddress(?string $emailAddress): FreightDirectDataDetails
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function addPhoneNumber($phoneNumber, $type = 'HOME'): FreightDirectDataDetails
    {
        $this->phoneNumberDetails[] = [
            'phoneNumber' => $phoneNumber,
            'phoneNumberType' => $type
        ];
        return $this;
    }

    public function prepare()
    {
        $data = [];
        
        if (!empty($this->type)) {
            $data['type'] = $this->type;
        }

        if (!empty($this->transportationType)) {
            $data['transportationType'] = $this->transportationType;
        }

        if (!empty($this->emailAddress)) {
            $data['emailAddress'] = $this->emailAddress;
        }

        if (!empty($this->phoneNumberDetails)) {
            $data['phoneNumberDetails'] = $this->phoneNumberDetails;
        }

        return $data;
    }
}
