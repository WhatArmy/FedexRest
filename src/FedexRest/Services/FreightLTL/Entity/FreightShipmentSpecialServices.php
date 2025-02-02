<?php

namespace FedexRest\Services\FreightLTL\Entity;

class FreightShipmentSpecialServices
{
    protected ?string $freightGuaranteeType = null;
    protected ?string $guaranteeTimestamp = null;
    protected ?array $specialServiceTypes = null;
    protected ?FreightDirectDetail $freightDirectDetail = null;


    /**
     * Set the value of freightGuaranteeType
     * @param string|null $freightGuaranteeType
     * @return  $this
     */
    public function setFreightGuaranteeType(?string $freightGuaranteeType): self
    {
        $this->freightGuaranteeType = $freightGuaranteeType;

        return $this;
    }

    /**
     * Set the value of guaranteeTimestamp
     * @param string|null $guaranteeTimestamp
     * @return  $this
     */
    public function setGuaranteeTimestamp(?string $guaranteeTimestamp): self
    {
        $this->guaranteeTimestamp = $guaranteeTimestamp;

        return $this;
    }

    /**
     * Set the value of specialServiceTypes
     * @param string|null $specialServiceTypes
     * @return  $this
     */
    public function setSpecialServiceTypes(?string ...$specialServiceTypes): self
    {
        $this->specialServiceTypes = $specialServiceTypes;

        return $this;
    }

    /**
     * Set the value of freightDirectDetail
     * @param FreightDirectDetail|null $freightDirectDetail
     * @return  $this
     */
    public function setFreightDirectDetail(?FreightDirectDetail $freightDirectDetail): self
    {
        $this->freightDirectDetail = $freightDirectDetail;

        return $this;
    }



    public function prepare(): array
    {
        $data = [];

        if(!empty($this->freightGuaranteeType) || !empty($this->guaranteeTimestamp)) {
            $data['freightGuaranteeDetail'] = [];
            if (!empty($this->freightGuaranteeType)) {
                $data['freightGuaranteeDetail']['freightGuaranteeType'] = $this->freightGuaranteeType;
            }
            if (!empty($this->guaranteeTimestamp)) {
                $data['freightGuaranteeDetail']['guaranteeTimestamp'] = $this->guaranteeTimestamp;
            }
        }
            

        if (!empty($this->specialServiceTypes)) {
            $data['specialServiceTypes'] = $this->specialServiceTypes;
        }

        if (!empty($this->freightDirectDetail)) {
            $data['freightDirectDetail'] = $this->freightDirectDetail->prepare();
        }

        return $data;
    }
}
