<?php

namespace FedexRest\Services\FreightLTL;

use FedexRest\Services\AbstractRequest;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\FreightLTL\Entity\RateFreightRequestedShipment;
use FedexRest\Services\FreightLTL\Entity\RateRequestControlParameters;
use FedexRest\Services\FreightLTL\Exceptions\MissingFreightRequestedShipment;

class RateFreightLTL extends AbstractRequest
{
    protected string $accountNumber = '';
    protected ?RateRequestControlParameters $rateRequestControlParameters = null;
    protected RateFreightRequestedShipment $freightRequestedShipment;

    public function setApiEndpoint(): string
    {
        return '/rate/v1/freight/rates/quotes';
    }

    public function prepare()
    {
        $data = [
            'accountNumber' => [
                'value' => $this->accountNumber,
            ],
            'rateRequestControlParameters' => $this->rateRequestControlParameters->prepare(),
            'freightRequestedShipment' => $this->freightRequestedShipment->prepare(),
        ];
        return $data;
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
     * Set the value of rateRequestControlParameters
     * @param RateRequestControlParameters|null $rateRequestControlParameters
     * @return  $this
     */
    public function setRateRequestControlParameters(?RateRequestControlParameters $rateRequestControlParameters): self
    {
        $this->rateRequestControlParameters = $rateRequestControlParameters;

        return $this;
    }

    /**
     * Set the value of freightRequestedShipment
     * @param RateFreightRequestedShipment $freightRequestedShipment
     * @return  $this
     */
    public function setFreightRequestedShipment(RateFreightRequestedShipment $freightRequestedShipment): self
    {
        $this->freightRequestedShipment = $freightRequestedShipment;

        return $this;
    }


    public function request()
    {
        parent::request();

        if (empty($this->accountNumber)) {
            throw new MissingAccountNumberException('Account Number is missing.');
        }

        if (empty($this->freightRequestedShipment)) {
            throw new MissingFreightRequestedShipment('Freight Requested Shipment is missing.');
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
