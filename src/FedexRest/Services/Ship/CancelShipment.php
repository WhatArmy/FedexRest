<?php

namespace FedexRest\Services\Ship;

use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Exceptions\MissingTrackingNumberException;
use FedexRest\Services\AbstractRequest;
use GuzzleHttp\Exception\GuzzleException;

class CancelShipment extends AbstractRequest
{
    protected int $accountNumber;
    protected string $trackingNumber;

    public function setApiEndpoint(): string
    {
        return '/ship/v1/shipments/cancel';
    }

    /**
     * @param int $accountNumber
     * @return $this
     */
    public function setAccountNumber(int $accountNumber): CancelShipment
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @param string $trackingNumber
     * @return $this
     */
    public function setTrackingNumber(string $trackingNumber): CancelShipment
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    public function prepare(): array
    {
        return [
            'trackingNumber' => $this->trackingNumber,
            'accountNumber' => [
                'value' => $this->accountNumber,
            ],
        ];
    }

    /**
     * @throws MissingAccessTokenException
     * @throws MissingAccountNumberException
     * @throws MissingTrackingNumberException
     * @throws GuzzleException
     */
    public function request()
    {
        parent::request();
        if (empty($this->accountNumber)) {
            throw new MissingAccountNumberException('The account number is required');
        }
        if (empty($this->trackingNumber)) {
            throw new MissingTrackingNumberException('The tracking number is required');
        }

        try {
            $query = $this->http_client->put($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => false,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
