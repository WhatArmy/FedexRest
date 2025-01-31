<?php

namespace FedexRest\Services\FreightLTL\Entity;

use FedexRest\Entity\Weight;
use FedexRest\Entity\Address;
use FedexRest\Entity\Dimensions;
use FedexRest\Services\FreightLTL\Entity\FreightDirectDetail;

class FreightPickupLineItem
{
    protected ?string $trackingNumber = null;
    protected ?string $trackingQualifier = null;
    protected ?string $trackingCarrier = null;
    protected ?string $trackingUniqueId = null;
    protected ?string $service = null;
    protected ?int $sequenceNumber = null;
    protected ?int $totalHandlingUnits = null;
    protected ?bool $justOneMore = null;
    protected ?string $description = null;
    protected ?string $packaging = null; //SubPackagingType
    protected ?int $pieces = null;
    protected ?Weight $weight = null;
    protected ?Dimensions $dimensions = null;
    protected ?Address $destination = null;
    protected ?string $freightGuarenteeTime = null;
    protected ?FreightDirectDetail $freightDirectDetail = null;
    protected ?array $specialServiceTypes = null; //ShipmentSpecialServiceType

    /**
     * @param string|null $trackingUniqueId
     * @return FreightPickupLineItem
     */
    public function setTrackingNumber(?string $trackingNumber): FreightPickupLineItem
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @param string|null $trackingQualifier
     * @return FreightPickupLineItem
     */
    public function setTrackingQualifier(?string $trackingQualifier): FreightPickupLineItem
    {
        $this->trackingQualifier = $trackingQualifier;
        return $this;
    }

    /**
     * @param string|null $trackingCarrier
     * @return FreightPickupLineItem
     */
    public function setTrackingCarrier(?string $trackingCarrier): FreightPickupLineItem
    {
        $this->trackingCarrier = $trackingCarrier;
        return $this;
    }

    /**
     * @param string|null $trackingUniqueId
     * @return FreightPickupLineItem
     */
    public function setTrackingUniqueId(?string $trackingUniqueId): FreightPickupLineItem
    {
        $this->trackingUniqueId = $trackingUniqueId;
        return $this;
    }

    /**
     * @param string|null $service
     * @return FreightPickupLineItem
     */
    public function setService(?string $service): FreightPickupLineItem
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @param int|null $sequenceNumber
     * @return FreightPickupLineItem
     */
    public function setSequenceNumber(?int $sequenceNumber): FreightPickupLineItem
    {
        $this->sequenceNumber = $sequenceNumber;
        return $this;
    }

    /**
     * @param int|null $totalHandlingUnits
     * @return FreightPickupLineItem
     */
    public function setTotalHandlingUnits(?int $totalHandlingUnits): FreightPickupLineItem
    {
        $this->totalHandlingUnits = $totalHandlingUnits;
        return $this;
    }

    /**
     * @param bool|null $justOneMore
     * @return FreightPickupLineItem
     */
    public function setJustOneMore(?bool $justOneMore): FreightPickupLineItem
    {
        $this->justOneMore = $justOneMore;
        return $this;
    }

    /**
     * @param string|null $description
     * @return FreightPickupLineItem
     */
    public function setDescription(?string $description): FreightPickupLineItem
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string|null $packaging
     * @return FreightPickupLineItem
     */
    public function setPackaging(?string $packaging): FreightPickupLineItem
    {
        $this->packaging = $packaging;
        return $this;
    }

    /**
     * @param int|null $pieces
     * @return FreightPickupLineItem
     */
    public function setPieces(?int $pieces): FreightPickupLineItem
    {
        $this->pieces = $pieces;
        return $this;
    }

    /**
     * @param Weight|null $weight
     * @return FreightPickupLineItem
     */
    public function setWeight(?Weight $weight): FreightPickupLineItem
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param Dimensions|null $dimensions
     * @return FreightPickupLineItem
     */
    public function setDimensions(?Dimensions $dimensions): FreightPickupLineItem
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @param Address|null $destination
     * @return FreightPickupLineItem
     */
    public function setDestination(?Address $destination): FreightPickupLineItem
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param string|null $freightGuarenteeTime
     * @return FreightPickupLineItem
     */
    public function setFreightGuarenteeTime(?string $freightGuarenteeTime): FreightPickupLineItem
    {
        $this->freightGuarenteeTime = $freightGuarenteeTime;
        return $this;
    }

    /**
     * @param FreightDirectDetail|null $freightDirectDetail
     * @return FreightPickupLineItem
     */
    public function setFreightDirectDetail(?FreightDirectDetail $freightDirectDetail): FreightPickupLineItem
    {
        $this->freightDirectDetail = $freightDirectDetail;
        return $this;
    }

    /**
     * @param array|null $specialServiceTypes
     * @return FreightPickupLineItem
     */
    public function setSpecialServiceTypes(?array $specialServiceTypes): FreightPickupLineItem
    {
        $this->specialServiceTypes = $specialServiceTypes;
        return $this;
    }

    public function prepare()
    {
        $data = [];

        if (!empty($this->trackingNumber) || !empty($this->trackingQualifier) || !empty($this->trackingCarrier) || !empty($this->trackingUniqueId)) {
            $data['trackingNumber'] = [];
            if (!empty($this->trackingNumber)) {
                $data['trackingNumber']['trackingNumber'] = $this->trackingNumber;
            }
            if (!empty($this->trackingQualifier)) {
                $data['trackingNumber']['trackingQualifier'] = $this->trackingQualifier;
            }
            if (!empty($this->trackingCarrier)) {
                $data['trackingNumber']['trackingCarrier'] = $this->trackingCarrier;
            }
            if (!empty($this->trackingUniqueId)) {
                $data['trackingNumber']['trackingUniqueId'] = $this->trackingUniqueId;
            }
        }

        if (!empty($this->service)) {
            $data['service'] = $this->service;
        }

        if(!empty($this->service)) {
            $data['service'] = $this->service;
        }

        if (!empty($this->service)) {
            $data['service'] = $this->service;
        }

        if (!empty($this->sequenceNumber)) {
            $data['sequenceNumber'] = $this->sequenceNumber;
        }

        if (!empty($this->totalHandlingUnits)) {
            $data['totalHandlingUnits'] = $this->totalHandlingUnits;
        }

        if (!empty($this->justOneMore)) {
            $data['justOneMore'] = $this->justOneMore;
        }

        if (!empty($this->description)) {
            $data['description'] = $this->description;
        }

        if (!empty($this->packaging)) {
            $data['packaging'] = $this->packaging;
        }

        if (!empty($this->pieces)) {
            $data['pieces'] = $this->pieces;
        }

        if (!empty($this->weight)) {
            $data['weight'] = $this->weight->prepare();
        }

        if (!empty($this->dimensions)) {
            $data['dimensions'] = $this->dimensions->prepare();
        }

        if (!empty($this->destination)) {
            $data['destination'] = $this->destination->prepare();
        }

        if(!empty($this->freightGuarenteeTime) || !empty($this->freightDirectDetail) || !empty($this->specialServiceTypes)) {
            $data['shipmentSpecialServicesRequested'] = [];

            if(!empty($this->freightGuarenteeTime)) {
                $data['shipmentSpecialServicesRequested']['freightGuaranteeDetail'] = [];
                $data['shipmentSpecialServicesRequested']['freightGuaranteeDetail']['time'] = $this->freightGuarenteeTime;
            }

            if(!empty($this->freightDirectDetail)) {
                $data['shipmentSpecialServicesRequested']['freightDirectDetail'] = $this->freightDirectDetail->prepare();
            }

            if(!empty($this->specialServiceTypes)) {
                $data['shipmentSpecialServicesRequested']['specialServiceTypes'] = $this->specialServiceTypes;
            }
        }


        return $data;
    }


}
