<?php

namespace FedexRest\Entity;

class Weight
{
    public string $unit = '';
    public float $value = 0;

    /**
     * @param  string  $unit
     * @return Weight
     */
    public function setUnit(string $unit): Weight
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @param  float  $value
     * @return Weight
     */
    public function setValue(float $value): Weight
    {
        $this->value = $value;
        return $this;
    }

    public function prepare(): array {
        $data = [];
        if (!empty($this->value)) {
            $data['value'] = $this->value;
        }
        if (!empty($this->unit)) {
            $data['units'] = $this->unit;
        }
        return $data;
    }


}
