<?php

namespace FedexRest\Services\Rates;

use Exception;
use FedexRest\Entity\Item;
use FedexRest\Entity\Person;
use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Exceptions\MissingLineItemException;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\Ship\Entity\Label;
use FedexRest\Services\Ship\Entity\ShipmentSpecialServices;
use FedexRest\Services\Ship\Entity\ShippingChargesPayment;
use GuzzleHttp\Exception\GuzzleException;

class CreateRatesRequest extends AbstractRequest
{
    protected Person $shipper;
    protected Person $recipient;
    protected Label $label;
    protected ?string $shipDateStamp;
    protected ?string $serviceType;
    protected array $rateRequestTypes;
    protected string $packagingType = '';
    protected string $pickupType = '';
    protected int $accountNumber;
    protected array $lineItems = [];
    protected ShipmentSpecialServices $shipmentSpecialServices;
    protected ShippingChargesPayment $shippingChargesPayment;
    protected int $totalWeight;
    protected string $preferredCurrency = '';
    protected int $totalPackageCount;

    /**
     * {@inheritDoc}
     */
    public function setApiEndpoint()
    {
        return '/rate/v1/rates/quotes';
    }

    /**
     * @param Person $shipper
     * @return $this
     */
    public function setShipper(Person $shipper): CreateRatesRequest
    {
        $this->shipper = $shipper;
        return $this;
    }

    /**
     * @return Person
     */
    public function getShipper(): Person
    {
        return $this->shipper;
    }

    /**
     * @param Person $recipient
     * @return $this
     */
    public function setRecipient(Person $recipient): CreateRatesRequest
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return Person
     */
    public function getRecipient(): Person
    {
        return $this->recipient;
    }

    /**
     * @param string $shipDateStamp
     * @return $this
     */
    public function setShipDateStamp(string $shipDateStamp): CreateRatesRequest
    {
        $this->shipDateStamp = $shipDateStamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipDateStamp(): string
    {
        return $this->shipDateStamp;
    }

    /**
     * @param string $serviceType
     * @return $this
     */
    public function setServiceType(string $serviceType): CreateRatesRequest
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string $packagingType
     * @return $this
     */
    public function setPackagingType(string $packagingType): CreateRatesRequest
    {
        $this->packagingType = $packagingType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPackagingType(): string
    {
        return $this->packagingType;
    }

    /**
     * @param string $pickupType
     * @return $this
     *   The shipment.
     */
    public function setPickupType(string $pickupType): CreateRatesRequest
    {
        $this->pickupType = $pickupType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickupType(): string
    {
        return $this->pickupType;
    }

    /**
     * @param int $accountNumber
     * @return $this
     */
    public function setAccountNumber(int $accountNumber): CreateRatesRequest
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    public function setRateRequestTypes(string ...$rateRequestTypes): CreateRatesRequest
    {
        $this->rateRequestTypes = $rateRequestTypes;
        return $this;
    }

    public function getRateRequestTypes(array $rateRequestTypes): array
    {
        return $this->rateRequestTypes;
    }

    /**
     * @param Item ...$lineItems
     * @return $this
     */
    public function setLineItems(Item ...$lineItems): CreateRatesRequest
    {
        $this->lineItems = $lineItems;
        return $this;
    }

    /**
     * @return array
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @param ShipmentSpecialServices $shipmentSpecialServices
     * @return $this
     */
    public function setShipmentSpecialServices(ShipmentSpecialServices $shipmentSpecialServices): CreateRatesRequest
    {
        $this->shipmentSpecialServices = $shipmentSpecialServices;
        return $this;
    }


    /**
     * @return ShipmentSpecialServices
     */
    public function getShipmentSpecialServices(): ShipmentSpecialServices
    {
        return $this->shipmentSpecialServices;
    }

    /**
     * @param ShippingChargesPayment $shippingChargesPayment
     * @return $this
     */
    public function setShippingChargesPayment(ShippingChargesPayment $shippingChargesPayment): CreateRatesRequest
    {
        $this->shippingChargesPayment = $shippingChargesPayment;
        return $this;
    }

    /**
     * @return ShippingChargesPayment
     */
    public function getShippingChargesPayment(): ShippingChargesPayment
    {
        return $this->shippingChargesPayment;
    }

    /**
     * @param int $totalWeight
     * @return $this
     */
    public function setTotalWeight(int $totalWeight): CreateRatesRequest
    {
        $this->totalWeight = $totalWeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalWeight(): int
    {
        return $this->totalWeight;
    }

    /**
     * @param string $preferredCurrency
     * @return CreateRatesRequest
     */
    public function setPreferredCurrency(string $preferredCurrency): CreateRatesRequest
    {
        $this->preferredCurrency = $preferredCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreferredCurrency(): string
    {
        return $this->preferredCurrency;
    }

    /**
     * @param int $totalPackageCount
     * @return CreateRatesRequest
     */
    public function setTotalPackageCount(int $totalPackageCount): CreateRatesRequest
    {
        $this->totalPackageCount = $totalPackageCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPackageCount(): int
    {
        return $this->totalPackageCount;
    }

    /**
     * @return array
     */
    public function getRequestedShipment(): array
    {
        $line_items = [];
        foreach ($this->lineItems as $line_item) {
            /** @var Item $line_item */
            $line_items[] = $line_item->prepare();
        }

        $data = [
            'shipper' => $this->shipper->prepare(),
            'recipient' => $this->recipient->prepare(),
            'pickupType' => $this->pickupType,
            'requestedPackageLineItems' => $line_items,
        ];

        if (!empty($this->shipmentSpecialServices)) {
            $data['shipmentSpecialServices'] = $this->shipmentSpecialServices->prepare();
        }

        if (!empty($this->serviceType)) {
            $data['serviceType'] = $this->serviceType;
        }

        if (!empty($this->rateRequestTypes)) {
            $data['rateRequestType'] = $this->rateRequestTypes;
        }

        if (!empty($this->packagingType)) {
            $data['packagingType'] = $this->packagingType;
        }

        if (!empty($this->shipDateStamp)) {
            $data['shipDateStamp'] = $this->shipDateStamp;
        }

        if (!empty($this->totalWeight)) {
            $data['totalWeight'] = $this->totalWeight;
        }

        if (!empty($this->preferredCurrency)) {
            $data['preferredCurrency'] = $this->preferredCurrency;
        }

        if (!empty($this->totalPackageCount)) {
            $data['totalPackageCount'] = $this->totalPackageCount;
        }

        return $data;
    }

    public function prepare(): array
    {
        return [
            'accountNumber' => [
                'value' => $this->accountNumber,
            ],
            'requestedShipment' => $this->getRequestedShipment(),
        ];
    }

    /**
     * @throws MissingLineItemException
     * @throws MissingAccessTokenException
     * @throws GuzzleException
     * @throws MissingAccountNumberException
     */
    public function request()
    {
        parent::request();
        if (empty($this->accountNumber)) {
            throw new MissingAccountNumberException('The account number is required');
        }
        if (empty($this->lineItems)) {
            throw new MissingLineItemException('Line items are required');
        }

        try {
            $query = $this->http_client->post($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => false,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
