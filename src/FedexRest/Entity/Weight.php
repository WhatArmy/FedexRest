<?php

namespace FedexRest\Entity;

class Weight
{
    public string $unit = '';
    public string $value = '';

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
     * @param  int  $value
     * @return Weight
     */
    public function setValue(int $value): Weight
    {
        $this->value = $value;
        return $this;
    }


}
