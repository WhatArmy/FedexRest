<?php

namespace FedexRest\Services\Pickup\Entity;

use FedexRest\Entity\Dimensions;

class ExpressFreightDetail
{

    protected ?string $truckType = null;
    protected ?string $service = null;
    protected ?string $trailerLength = null;
    protected ?string $bookingNumber = null;
    protected ?Dimensions $dimensions = null;

    /**
     * @return string|null
     */
    public function getTruckType(): ?string
    {
        return $this->truckType;
    }

    /**
     * @param string|null $truckType
     * @return ExpressFreightDetail
     */
    public function setTruckType(?string $truckType): ExpressFreightDetail
    {
        $this->truckType = $truckType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getService(): ?string
    {
        return $this->service;
    }

    /**
     * @param string|null $service
     * @return ExpressFreightDetail
     */
    public function setService(?string $service): ExpressFreightDetail
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrailerLength(): ?string
    {
        return $this->trailerLength;
    }

    /**
     * @param string|null $trailerLength
     * @return ExpressFreightDetail
     */
    public function setTrailerLength(?string $trailerLength): ExpressFreightDetail
    {
        $this->trailerLength = $trailerLength;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBookingNumber(): ?string
    {
        return $this->bookingNumber;
    }

    /**
     * @param string|null $bookingNumber
     * @return ExpressFreightDetail
     */
    public function setBookingNumber(?string $bookingNumber): ExpressFreightDetail
    {
        $this->bookingNumber = $bookingNumber;
        return $this;
    }

    /**
     * @return Dimensions|null
     */
    public function getDimensions(): ?Dimensions
    {
        return $this->dimensions;
    }

    /**
     * @param Dimensions|null $dimensions
     * @return ExpressFreightDetail
     */
    public function setDimensions(?Dimensions $dimensions): ExpressFreightDetail
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->truckType)) {
            $data['truckType'] = $this->truckType;
        }
        if (!empty($this->service)) {
            $data['service'] = $this->service;
        }
        if (!empty($this->trailerLength)) {
            $data['trailerLength'] = $this->trailerLength;
        }
        if (!empty($this->bookingNumber)) {
            $data['bookingNumber'] = $this->bookingNumber;
        }
        if (!empty($this->dimensions)) {
            $data['dimensions'] = $this->dimensions->prepare();
        }
        return $data;
    }
}