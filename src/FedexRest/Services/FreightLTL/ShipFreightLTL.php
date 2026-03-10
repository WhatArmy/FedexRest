<?php

namespace FedexRest\Services\FreightLTL;

use FedexRest\Services\AbstractRequest;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\FreightLTL\Entity\FreightRequestedShipment;

class ShipFreightLTL extends AbstractRequest
{
    protected FreightRequestedShipment $freightRequestedShipment;
    protected string $labelResponseOptions = '';
    protected string $accountNumber = '';
    protected ?bool $oneLabelAtATime = false;


    public function setApiEndpoint(): string
    {
        return '/ship/v1/freight/shipments';
    }

    /**
     * Set the value of freightRequestedShipment
     * @param FreightRequestedShipment $freightRequestedShipment
     * @return  $this
     */
    public function setFreightRequestedShipment(FreightRequestedShipment $freightRequestedShipment): self
    {
        $this->freightRequestedShipment = $freightRequestedShipment;

        return $this;
    }

    /**
     * Set the value of labelResponseOptions
     * @param string $labelResponseOptions
     * @return  $this
     */
    public function setLabelResponseOptions(string $labelResponseOptions): self
    {
        $this->labelResponseOptions = $labelResponseOptions;

        return $this;
    }

    /**
     * Set the value of accountNumber
     * @param string $accountNumber
     * @return  $this
     */
    public function setAccountNumber(string $accountNumber): self
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Set the value of oneLabelAtATime
     * @param bool|null $oneLabelAtATime
     * @return  $this
     */
    public function setOneLabelAtATime(?bool $oneLabelAtATime): self
    {
        $this->oneLabelAtATime = $oneLabelAtATime;

        return $this;
    }

    public function prepare()
    {
        $data = [
            'freightRequestedShipment' => $this->freightRequestedShipment->prepare(),
            'labelResponseOptions' => $this->labelResponseOptions,
            'accountNumber' => $this->accountNumber,
        ];

        if ($this->oneLabelAtATime) {
            $data['oneLabelAtATime'] = $this->oneLabelAtATime;
        }
        return $data;
    }

    public function request()
    {
        parent::request();

        if (empty($this->accountNumber)) {
            throw new MissingAccountNumberException('The account number is required');
        }

        try {
            $query = $this->http_client->post($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => FALSE,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }   
    }
}
