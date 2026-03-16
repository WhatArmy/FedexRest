<?php

namespace FedexRest\Services\FreightLTL;

use FedexRest\Entity\Weight;
use FedexRest\Entity\Address;
use FedexRest\Entity\Dimensions;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\FreightLTL\Entity\FreightDirectDetail;
use FedexRest\Services\FreightLTL\Exceptions\MissingFreightPickupDetailException;

class CheckFreightLTLPickupAvailability extends AbstractRequest
{
    protected ?Address $pickupAddress = null;
    protected ?string $packageReadyTime = null;
    protected ?string $customerCloseTime = null;
    protected ?string $serviceType = null;
    protected ?Weight $weight = null;
    protected ?string $packagingType = null;
    protected ?Dimensions $dimensions = null;
    protected ?string $freightGuaranteeTime = null;
    protected ?FreightDirectDetail $freightDirectDetail = null;
    protected ?array $specialServiceTypes = null;
    protected ?string $dispatchDate = null;
    protected ?int $numberOfBusinessDays = null;

    public function setApiEndpoint(): string
	{
		return '/pickup/v1/freight/pickups/availabilities';
	}

    /**
     * @param Address|null $pickupAddress
     * @return CheckFreightLTLPickupAvailability
     */
    public function setPickupAddress(?Address $pickupAddress): CheckFreightLTLPickupAvailability
    {
        $this->pickupAddress = $pickupAddress;
        return $this;
    }

    /**
     * @param string|null $packageReadyTime
     * @return CheckFreightLTLPickupAvailability
     */
    public function setPackageReadyTime(?string $packageReadyTime): CheckFreightLTLPickupAvailability
    {
        $this->packageReadyTime = $packageReadyTime;
        return $this;
    }

    /**
     * @param string|null $customerCloseTime
     * @return CheckFreightLTLPickupAvailability
     */
    public function setCustomerCloseTime(?string $customerCloseTime): CheckFreightLTLPickupAvailability
    {
        $this->customerCloseTime = $customerCloseTime;
        return $this;
    }

    /**
     * @param string|null $ServiceType
     * @return CheckFreightLTLPickupAvailability
     */
    public function setServiceType(?string $serviceType): CheckFreightLTLPickupAvailability
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @param Weight|null $weight
     * @return CheckFreightLTLPickupAvailability
     */
    public function setWeight(?Weight $weight): CheckFreightLTLPickupAvailability
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param string|null $packagingType
     * @return CheckFreightLTLPickupAvailability
     */
    public function setPackagingType(?string $packagingType): CheckFreightLTLPickupAvailability
    {
        $this->packagingType = $packagingType;
        return $this;
    }

    /**
     * @param Dimensions|null $dimensions
     * @return CheckFreightLTLPickupAvailability
     */
    public function setDimensions(?Dimensions $dimensions): CheckFreightLTLPickupAvailability
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @param string|null $freightGuaranteeTime
     * @return CheckFreightLTLPickupAvailability
     */
    public function setFreightGuaranteeTime(?string $freightGuaranteeTime): CheckFreightLTLPickupAvailability
    {
        $this->freightGuaranteeTime = $freightGuaranteeTime;
        return $this;
    }

    /**
     * @param FreightDirectDetail|null $freightDirectDetail
     * @return CheckFreightLTLPickupAvailability
     */
    public function setFreightDirectDetail(?FreightDirectDetail $freightDirectDetail): CheckFreightLTLPickupAvailability
    {
        $this->freightDirectDetail = $freightDirectDetail;
        return $this;
    }

    /**
     * @param array|null $specialServiceTypes
     * @return CheckFreightLTLPickupAvailability
     */
    public function setSpecialServiceTypes(?string ...$specialServiceTypes): CheckFreightLTLPickupAvailability
    {
        $this->specialServiceTypes = $specialServiceTypes;
        return $this;
    }

    /**
     * @param string|null $dispatchDate
     * @return CheckFreightLTLPickupAvailability
     */
    public function setDispatchDate(?string $dispatchDate): CheckFreightLTLPickupAvailability
    {
        $this->dispatchDate = $dispatchDate;
        return $this;
    }

    /**
     * @param int|null $numberOfBusinessDays
     * @return CheckFreightLTLPickupAvailability
     */
    public function setNumberOfBusinessDays(?int $numberOfBusinessDays): CheckFreightLTLPickupAvailability
    {
        $this->numberOfBusinessDays = $numberOfBusinessDays;
        return $this;
    }

    
    public function prepare(): array
    {
        $data = [];

        if (!empty($this->pickupAddress)) {
            $data['pickupAddress'] = $this->pickupAddress->prepare();
        }

        if (!empty($this->packageReadyTime)) {
            $data['packageReadyTime'] = $this->packageReadyTime;
        }

        if (!empty($this->customerCloseTime)) {
            $data['customerCloseTime'] = $this->customerCloseTime;
        }

        if (!empty($this->serviceType) || !empty($this->weight) || !empty($this->packagingType) || !empty($this->dimensions)) {
            $data['shipmentAttributes'] = [];

            if (!empty($this->serviceType)) {
                $data['shipmentAttributes']['serviceType'] = $this->serviceType;
            }

            if (!empty($this->weight)) {
                $data['shipmentAttributes']['weight'] = $this->weight->prepare();
            }

            if (!empty($this->packagingType)) {
                $data['shipmentAttributes']['packagingType'] = $this->packagingType;
            }

            if (!empty($this->dimensions)) {
                $data['shipmentAttributes']['dimensions'] = $this->dimensions->prepare();
            }
        }

        if (!empty($this->freightGuaranteeTime) || !empty($this->freightDirectDetail) || !empty($this->specialServiceTypes)) {
            $data['freightPickupSpecialServiceDetail'] = [];
            $data['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested'] = [];

            if (!empty($this->freightGuaranteeTime)) {
                $data['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightGuaranteeDetail'] = ['time'=>$this->freightGuaranteeTime];
            }

            if (!empty($this->freightDirectDetail)) {
                $data['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightDirectDetail'] = $this->freightDirectDetail->prepare();
            }

            if (!empty($this->specialServiceTypes)) {
                $data['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['specialServiceTypes'] = $this->specialServiceTypes;
            }
        }

        if (!empty($this->dispatchDate)) {
            $data['dispatchDate'] = $this->dispatchDate;
        }

        if (!empty($this->numberOfBusinessDays)) {
            $data['numberOfBusinessDays'] = $this->numberOfBusinessDays;
        }

        return $data;
    }


    public function request()
    {
        parent::request();

        if (empty($this->pickupAddress)) {
            throw new MissingFreightPickupDetailException('Pickup Address is required.');
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
