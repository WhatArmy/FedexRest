<?php

namespace FedexRest\Services\Ship\Entity;

use FedexRest\Entity\Weight;
use FedexRest\Services\Ship\Entity\Value;

class Commodities
{
    public string $name;
    public string $description;
    public string $countryOfManufacture;
    public string $quantity;
    public string $harmonizedCode;
    public ?Weight $weight;
    public ?Value $customsValue;
    
    /**
     * @param  string $name
     * @return $this
     */
    public function setName(string $name): Commodities
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @param  string  $description
     * @return $this
     */
    public function setDescription(string $description): Commodities
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * @param  string $countryOfManufacture
     * @return $this
     */
    public function setCountryOfManufacture(string $countryOfManufacture): Commodities
    {
        $this->countryOfManufacture = $countryOfManufacture;
        return $this;
    }
    
    /**
     * @param  string $countryOfManufacture
     * @return $this
     */
    public function setQuantity(string $quantity): Commodities
    {
        $this->quantity = $quantity;
        return $this;
    }
    
    /**
     * @param  string $harmonizedCode
     * @return $this
     */
    public function setHarmonizedCode(string $harmonizedCode): Commodities
    {
        $this->harmonizedCode = $harmonizedCode;
        return $this;
    }
    
    /**
     * @param  Value $customsValue
     * @return $this
     */
    public function setCustomsValue(Value $customsValue): Commodities
    {
        $this->customsValue = $customsValue;
        return $this;
    }
    
    /**
     * @param  Weight $weight
     * @return $this
     */
    public function setWeight(Weight $weight): Commodities
    {
        $this->weight = $weight;
        return $this;
    }
    

    public function prepare(): array {
        $data = [];
        if (!empty($this->name)) {
            $data['name'] = ($this->name);
        }
        if (!empty($this->description)) {
            $data['description'] = ($this->description);
        }
        if (!empty($this->countryOfManufacture)) {
            $data['countryOfManufacture'] = ($this->countryOfManufacture);
        }
        if (!empty($this->quantity)) {
            $data['quantity'] = ($this->quantity);
        }
        if (!empty($this->harmonizedCode)) {
            $data['harmonizedCode'] = ($this->harmonizedCode);
        }
        if (!empty($this->weight)) {
            $data['weight'] = ($this->weight);
        }        
        if (!empty($this->customsValue)) {
            $data['customsValue'] = ($this->customsValue);
        }        
        return $data;
    }


}
