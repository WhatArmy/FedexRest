<?php

namespace FedexRest\Entity;

/**
 * Class for creating a shipment's dimensions.
 */
class Dimensions
{
    public ?int $width;
    public ?int $height;
    public ?int $length;
    public string $units = '';

    /**
     * @param  int  $length
     * @return $this
     */
    public function setLength(int $length): Dimensions
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @param  int  $width
     * @return $this
     */
    public function setWidth(int $width): Dimensions
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param  int  $height
     * @return $this
     */
    public function setHeight(int $height): Dimensions
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param  string  $units
     * @return $this
     */
    public function setUnits(string $units): Dimensions
    {
        $this->units = $units;
        return $this;
    }

    /**
     * @return array
     */
    public function prepare(): array
    {
        $dimensions = [];
        if (!empty($this->length)) {
            $dimensions['length'] = $this->length;
        }
        if (!empty($this->width)) {
            $dimensions['width'] = $this->width;
        }
        if (!empty($this->height)) {
            $dimensions['height'] = $this->height;
        }
        if (!empty($this->units)) {
            $dimensions['units'] = $this->units;
        }
        return $dimensions;
    }

}
