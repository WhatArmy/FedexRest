<?php

namespace FedexRest\Entity;

use FedexRest\Entity\CustomerReference;
use FedexRest\Services\Ship\Entity\Value;

class Item
{
    public string $itemDescription = '';
    public ?Weight $weight;
    public ?Dimensions $dimensions;
    public ?int $groupPackageCount;
    public ?int $sequenceNumber;
    public ?string $subPackagingType;
    public ?Value $declaredValue;
    public ?PackageSpecialServicesRequested $packageSpecialServices;
    public array $customerReferences = [];

    /**
     * @param  string  $itemDescription
     * @return Item
     */
    public function setItemDescription(string $itemDescription): Item
    {
        $this->itemDescription = $itemDescription;
        return $this;
    }

    /**
     * @param  Weight|null  $weight
     * @return $this
     */
    public function setWeight(?Weight $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param  Dimensions|null $dimensions
     * @return $this
     */
    public function setDimensions(?Dimensions $dimensions): Item
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * @param int|null $groupPackageCount
     * @return $this
     */
    public function setGroupPackageCount(?int $groupPackageCount): Item
    {
        $this->groupPackageCount = $groupPackageCount;
        return $this;
    }

    /**
     * @param int|null $sequenceNumber
     * @return $this
     */
    public function setSequenceNumber(?int $sequenceNumber): Item
    {
        $this->sequenceNumber = $sequenceNumber;
        return $this;
    }

    /**
     * @param string $subPackagingType
     * @return $this
     */
    public function setSubPackagingType(string $subPackagingType): Item
    {
        $this->subPackagingType = $subPackagingType;
        return $this;
    }

    /**
     * @param Value|null $declaredValue
     * @return $this
     */
    public function setDeclaredValue(?Value $declaredValue): Item
    {
        $this->declaredValue = $declaredValue;
        return $this;
    }

    /**
     * @param PackageSpecialServicesRequested|null $packageSpecialServices
     * @return $this
     */
    public function setPackageSpecialServices(?PackageSpecialServicesRequested $packageSpecialServices): Item
    {
        $this->packageSpecialServices = $packageSpecialServices;
        return $this;
    }

    public function setCustomerReferences(array $customerReferences): Item
    {
        $this->customerReferences = $customerReferences;
        return $this;
    }

    public function addCustomerReference(CustomerReference $customerReference): Item
    {
        $this->customerReferences[] = $customerReference;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];

        if (!empty($this->itemDescription)) {
            $data['itemDescription'] = $this->itemDescription;
        }

        if (!empty($this->weight)) {
            $data['weight'] = $this->weight->prepare();
        }

        if (!empty($this->dimensions)) {
            $data['dimensions'] = $this->dimensions->prepare();
        }

        if (!empty($this->groupPackageCount)) {
            $data['groupPackageCount'] = $this->groupPackageCount;
        }

        if (!empty($this->sequenceNumber)) {
            $data['sequenceNumber'] = $this->sequenceNumber;
        }

        if (!empty($this->subPackagingType)) {
            $data['subPackagingType'] = $this->subPackagingType;
        }

        if (!empty($this->declaredValue)) {
            $data['declaredValue'] = $this->declaredValue->prepare();
        }

        if (!empty($this->packageSpecialServices)) {
            $data['packageSpecialServices'] = $this->packageSpecialServices->prepare();
        }

        if (!empty($this->customerReferences)) {
            // Call `prepare()` on each element
            $data['customerReferences'] = array_map(
                fn(CustomerReference $custref): array => $custref->prepare(),
                $this->customerReferences
            );
        }

        return $data;
    }


}
