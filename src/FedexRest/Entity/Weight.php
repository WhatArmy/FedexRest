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
     * @param  string  $value
     * @return Weight
     */
    public function setValue(string $value): Weight
    {
        $this->value = $value;
        return $this;
    }


}
