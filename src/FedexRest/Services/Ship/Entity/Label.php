<?php

namespace FedexRest\Services\Ship\Entity;

class Label
{
    public ?string $imageType;
    public ?string $labelStockType;

    /**
     * @param string  $imageType
     * @return $this
     */
    public function setImageType(string $imageType): Label
    {
        $this->imageType = $imageType;
        return $this;
    }

    /**
     * @param string  $labelStockType
     * @return $this
     */
    public function setLabelStockType(string $labelStockType): Label
    {
        $this->labelStockType = $labelStockType;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->labelStockType)) {
            $data['labelStockType'] = $this->labelStockType;
        }
        if (!empty($this->imageType)) {
            $data['imageType'] = $this->imageType;
        }
        return $data;
    }
}
