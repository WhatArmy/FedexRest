<?php

namespace FedexRest\Services\Pickup\Entity;

class OriginDetail
{
    protected ?string $pickupAddressType = null;
    protected PickupLocation $pickupLocation;
    protected string $readyDateTimestamp;
    protected string $customerCloseTime;
    protected ?string $pickupDateType = null;
    protected ?string $packageLocation = null;
    protected ?string $buildingPart = null;
    protected ?string $buildingPartDescription = null;
    protected ?bool $earlyPickup = null;
    protected ?string $suppliesRequested = null;
    protected ?string $geographicalPostalCode = null;

    public function getPickupAddressType(): ?string
    {
        return $this->pickupAddressType;
    }

    public function setPickupAddressType(?string $pickupAddressType): OriginDetail
    {
        $this->pickupAddressType = $pickupAddressType;
        return $this;
    }

    public function getPickupLocation(): PickupLocation
    {
        return $this->pickupLocation;
    }

    public function setPickupLocation(PickupLocation $pickupLocation): OriginDetail
    {
        $this->pickupLocation = $pickupLocation;
        return $this;
    }

    public function getReadyDateTimestamp(): string
    {
        return $this->readyDateTimestamp;
    }

    public function setReadyDateTimestamp(string $readyDateTimestamp): OriginDetail
    {
        $this->readyDateTimestamp = $readyDateTimestamp;
        return $this;
    }

    public function getCustomerCloseTime(): string
    {
        return $this->customerCloseTime;
    }

    public function setCustomerCloseTime(string $customerCloseTime): OriginDetail
    {
        $this->customerCloseTime = $customerCloseTime;
        return $this;
    }

    public function getPickupDateType(): ?string
    {
        return $this->pickupDateType;
    }

    public function setPickupDateType(?string $pickupDateType): OriginDetail
    {
        $this->pickupDateType = $pickupDateType;
        return $this;
    }

    public function getPackageLocation(): ?string
    {
        return $this->packageLocation;
    }

    public function setPackageLocation(?string $packageLocation): OriginDetail
    {
        $this->packageLocation = $packageLocation;
        return $this;
    }

    public function getBuildingPart(): ?string
    {
        return $this->buildingPart;
    }

    public function setBuildingPart(?string $buildingPart): OriginDetail
    {
        $this->buildingPart = $buildingPart;
        return $this;
    }

    public function getBuildingPartDescription(): ?string
    {
        return $this->buildingPartDescription;
    }

    public function setBuildingPartDescription(?string $buildingPartDescription): OriginDetail
    {
        $this->buildingPartDescription = $buildingPartDescription;
        return $this;
    }

    public function getEarlyPickup(): ?bool
    {
        return $this->earlyPickup;
    }

    public function setEarlyPickup(?bool $earlyPickup): OriginDetail
    {
        $this->earlyPickup = $earlyPickup;
        return $this;
    }

    public function getSuppliesRequested(): ?string
    {
        return $this->suppliesRequested;
    }

    public function setSuppliesRequested(?string $suppliesRequested): OriginDetail
    {
        $this->suppliesRequested = $suppliesRequested;
        return $this;
    }

    public function getGeographicalPostalCode(): ?string
    {
        return $this->geographicalPostalCode;
    }

    public function setGeographicalPostalCode(?string $geographicalPostalCode): OriginDetail
    {
        $this->geographicalPostalCode = $geographicalPostalCode;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'pickupLocation' => $this->pickupLocation->prepare(),
            'readyDateTimestamp' => $this->readyDateTimestamp,
            'customerCloseTime' => $this->customerCloseTime,
        ];
        if (!empty($this->pickupAddressType)) {
            $data['pickupAddressType'] = $this->pickupAddressType;
        }
        if (!empty($this->pickupDateType)) {
            $data['pickupDateType'] = $this->pickupDateType;
        }
        if (!empty($this->packageLocation)) {
            $data['packageLocation'] = $this->packageLocation;
        }
        if (!empty($this->buildingPart)) {
            $data['buildingPart'] = $this->buildingPart;
        }
        if (!empty($this->buildingPartDescription)) {
            $data['buildingPartDescription'] = $this->buildingPartDescription;
        }
        if (!empty($this->earlyPickup)) {
            $data['earlyPickup'] = $this->earlyPickup;
        }
        if (!empty($this->suppliesRequested)) {
            $data['suppliesRequested'] = $this->suppliesRequested;
        }
        if (!empty($this->geographicalPostalCode)) {
            $data['geographicalPostalCode'] = $this->geographicalPostalCode;
        }
        return $data;
    }
}
