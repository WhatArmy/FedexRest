<?php

namespace FedexRest\Services\FreightLTL\Entity;

use FedexRest\Entity\Address;
use FedexRest\Services\Ship\Entity\ShippingChargesPayment;

class RateFreightRequestedShipment
{
    protected Address $shipper;
    protected Address $recipient;
    protected ?string $serviceType = null;
    protected ?string $preferredCurrency = null;
    protected ?ShippingChargesPayment $shippingChargesPayment = null;
    protected ?array $rateRequestType = null;
    protected ?string $shipDateStamp = null;
    protected array $requestedPackageLineItems;
    protected ?int $totalPackageCount = null;
    protected ?int $totalWeight = null;
    //TODO: freightShipmentDetail
    protected ?FreightShipmentSpecialServices $freightShipmentSpecialServices = null;



    
    /**
     * Set the value of shipper
     * @param Address $shipper
     * @return  $this
     */
    public function setShipperAddress(Address $shipper): self
    {
        $this->shipper = $shipper;
        return $this;
    }

    /**
     * Set the value of recipient
     * @param Address $recipient
     * @return  $this
     */
    public function setRecipientAddress(Address $recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Set the value of serviceType
     * @param string|null $serviceType
     * @return  $this
     */
    public function setServiceType(?string $serviceType): self
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * Set the value of preferredCurrency
     * @param string|null $preferredCurrency
     * @return  $this
     */
    public function setPreferredCurrency(?string $preferredCurrency): self
    {
        $this->preferredCurrency = $preferredCurrency;
        return $this;
    }

    /**
     * Set the value of shippingChargesPayment
     * @param ShippingChargesPayment|null $shippingChargesPayment
     * @return  $this
     */
    public function setShippingChargesPayment(?ShippingChargesPayment $shippingChargesPayment): self
    {
        $this->shippingChargesPayment = $shippingChargesPayment;
        return $this;
    }

    /**
     * Set the value of rateRequestType
     * @param string|null $rateRequestType
     * @return  $this
     */
    public function setRateRequestType(?string ...$rateRequestType): self
    {
        $this->rateRequestType = $rateRequestType;
        return $this;
    }

    /**
     * Set the value of shipDateStamp
     * @param string|null $shipDateStamp
     * @return  $this
     */
    public function setShipDateStamp(?string $shipDateStamp): self
    {
        $this->shipDateStamp = $shipDateStamp;
        return $this;
    }

    /**
     * Set the value of requestedPackageLineItems
     * @param array $requestedPackageLineItems
     * @return  $this
     */
    public function setRequestedPackageLineItems(FreightRateRequestedPackageLineItems ...$requestedPackageLineItems): self
    {
        $this->requestedPackageLineItems = $requestedPackageLineItems;
        return $this;
    }

    /**
     * Set the value of totalPackageCount
     * @param int|null $totalPackageCount
     * @return  $this
     */
    public function setTotalPackageCount(?int $totalPackageCount): self
    {
        $this->totalPackageCount = $totalPackageCount;
        return $this;
    }

    /**
     * Set the value of totalWeight
     * @param int|null $totalWeight
     * @return  $this
     */
    public function setTotalWeight(?int $totalWeight): self
    {
        $this->totalWeight = $totalWeight;
        return $this;
    }

    //TODO: freightShipmentDetail


    /**
     * Set the value of freightShipmentSpecialServices
     * @param FreightShipmentSpecialServices|null $freightShipmentSpecialServices
     * @return  $this
     */
    public function setFreightShipmentSpecialServices(?FreightShipmentSpecialServices $freightShipmentSpecialServices): self
    {
        $this->freightShipmentSpecialServices = $freightShipmentSpecialServices;
        return $this;
    }




    public function prepare(): array
    {
        $data = [];

        if (!empty($this->shipper)) {
            $data['shipper'] = [];
            $data['shipper']['address'] = $this->shipper->prepare();
        }

        if (!empty($this->recipient)) {
            $data['recipient'] = [];
            $data['recipient']['address'] = $this->recipient->prepare();
        }

        if (!empty($this->serviceType)) {
            $data['serviceType'] = $this->serviceType;
        }

        if (!empty($this->preferredCurrency)) {
            $data['preferredCurrency'] = $this->preferredCurrency;
        }

        if (!empty($this->shippingChargesPayment)) {
            $data['shippingChargesPayment'] = $this->shippingChargesPayment->prepare();
        }

        if (!empty($this->rateRequestType)) {
            $data['rateRequestType'] = $this->rateRequestType;
        }

        if (!empty($this->shipDateStamp)) {
            $data['shipDateStamp'] = $this->shipDateStamp;
        }

        //TODO: requestedPackageLineItems

        if (!empty($this->totalPackageCount)) {
            $data['totalPackageCount'] = $this->totalPackageCount;
        }

        if (!empty($this->totalWeight)) {
            $data['totalWeight'] = $this->totalWeight;
        }

        //TODO: freightShipmentDetail

        if (!empty($this->freightShipmentSpecialServices)) {
            $data['freightShipmentSpecialServices'] = $this->freightShipmentSpecialServices->prepare();
        }


        return $data;
    }
}
