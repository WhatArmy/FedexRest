<?php

namespace FedexRest\Services\TradeDocument\Entity;

class Meta
{
    public string $shipDocumentType;
    public string $originCountryCode;
    public string $destinationCountryCode;
    public ?string $formCode = null;
    public ?string $trackingNumber = null;
    public ?string $shipmentDate = null;
    public ?string $originLocationCode = null;
    public ?string $destinationLocationCode = null;

    public function setShipDocumentType(string $shipDocumentType): Meta
    {
        $this->shipDocumentType = $shipDocumentType;
        return $this;
    }

    public function setOriginCountryCode(string $originCountryCode): Meta
    {
        $this->originCountryCode = $originCountryCode;
        return $this;
    }

    public function setDestinationCountryCode(string $destinationCountryCode): Meta
    {
        $this->destinationCountryCode = $destinationCountryCode;
        return $this;
    }

    public function setFormCode(string $formCode): Meta
    {
        $this->formCode = $formCode;
        return $this;
    }

    public function setTrackingNumber(string $trackingNumber): Meta
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    public function setShipmentDate(string $shipmentDate): Meta
    {
        $this->shipmentDate = $shipmentDate;
        return $this;
    }

    public function setOriginLocationCode(string $originLocationCode): Meta
    {
        $this->originLocationCode = $originLocationCode;
        return $this;
    }

    public function setDestinationLocationCode(string $destinationLocationCode): Meta
    {
        $this->destinationLocationCode = $destinationLocationCode;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'shipDocumentType' => $this->shipDocumentType,
            'originCountryCode' => $this->originCountryCode,
            'destinationCountryCode' => $this->destinationCountryCode,
        ];
        if (!empty($this->formCode)) {
            $data['formCode'] = $this->formCode;
        }
        if (!empty($this->trackingNumber)) {
            $data['trackingNumber'] = $this->trackingNumber;
        }
        if (!empty($this->shipmentDate)) {
            $data['shipmentDate'] = $this->shipmentDate;
        }
        if (!empty($this->originLocationCode)) {
            $data['originLocationCode'] = $this->originLocationCode;
        }
        if (!empty($this->destinationLocationCode)) {
            $data['destinationLocationCode'] = $this->destinationLocationCode;
        }
        return $data;
    }
}
