<?php

namespace FedexRest\Entity;

class Item
{
    public string $itemDescription = '';
    public ?Weight $weight;
    public ?Dimensions $dimensions;
    public ?int $groupPackageCount;

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

        return $data;
    }


}
