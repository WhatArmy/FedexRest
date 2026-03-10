<?php

namespace FedexRest\Services\FreightLTL\Entity;

use FedexRest\Entity\Dimensions;
use FedexRest\Entity\Weight;
use FedexRest\Services\Ship\Entity\Value;

class FreightRateRequestedPackageLineItems
{
    protected string $subPackagingType = '';
    protected ?int $groupPackageCount = null;
    protected ?array $contentRecords = null;
    protected ?Value $declaredValue = null;
    protected Weight $weight;
    protected ?Dimensions $dimensions = null;
    protected array $associatedFreightLineItems;


    /**
     * Set the value of subPackagingType
     * @param string $subPackagingType
     * @return  $this
     */
    public function setSubPackagingType(string $subPackagingType): self
    {
        $this->subPackagingType = $subPackagingType;

        return $this;
    }

    /**
     * Set the value of groupPackageCount
     * @param int|null $groupPackageCount
     * @return  $this
     */
    public function setGroupPackageCount(?int $groupPackageCount): self
    {
        $this->groupPackageCount = $groupPackageCount;

        return $this;
    }

    /**
     * Set the value of contentRecords
     * @param array|null $contentRecords
     * @return  $this
     */
    public function setContentRecords(ContentRecord ...$contentRecords): self
    {
        $this->contentRecords = $contentRecords;

        return $this;
    }

    /**
     * Set the value of declaredValue
     * @param Value|null $declaredValue
     * @return  $this
     */
    public function setDeclaredValue(?Value $declaredValue): self
    {
        $this->declaredValue = $declaredValue;

        return $this;
    }

    /**
     * Set the value of weight
     * @param Weight $weight
     * @return  $this
     */
    public function setWeight(Weight $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Set the value of dimensions
     * @param Dimensions|null $dimensions
     * @return  $this
     */
    public function setDimensions(?Dimensions $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Set the value of associatedFreightLineItems
     * @param array $associatedFreightLineItems
     * @return  $this
     */
    public function setAssociatedFreightLineItems(AssociatedFreightLineItems ...$associatedFreightLineItems): self
    {
        $this->associatedFreightLineItems = $associatedFreightLineItems;

        return $this;
    }

    public function prepare(): array
    {
        $data = [];

        if (!empty($this->subPackagingType)) {
            $data['subPackagingType'] = $this->subPackagingType;
        }

        if (!empty($this->groupPackageCount)) {
            $data['groupPackageCount'] = $this->groupPackageCount;
        }

        if (!empty($this->contentRecords)) {
            $data['contentRecords'] = [];
            foreach ($this->contentRecords as $contentRecord) {
                $data['contentRecords'][] = $contentRecord->prepare();
            }
        }

        if (!empty($this->declaredValue)) {
            $data['declaredValue'] = $this->declaredValue->prepare();
        }

        if (!empty($this->weight)) {
            $data['weight'] = $this->weight->prepare();
        }

        if (!empty($this->dimensions)) {
            $data['dimensions'] = $this->dimensions->prepare();
        }

        if (!empty($this->associatedFreightLineItems)) {
            $data['associatedFreightLineItems'] = [];
            foreach ($this->associatedFreightLineItems as $associatedFreightLineItem) {
                $data['associatedFreightLineItems'][] = $associatedFreightLineItem->prepare();
            }
        }

        return $data;
    }
}
