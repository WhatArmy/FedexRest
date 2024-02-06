<?php

namespace FedexRest\Entity;

class Address
{
    public array $street_lines;
    public string $city;
    public string $state_or_province;
    public string $postal_code;
    public string $country_code;
    public bool $residential;

    /**
     * @param $street_lines
     * @return $this
     */
    public function setStreetLines(...$street_lines)
    {
        $this->street_lines = $street_lines;
        return $this;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $state_or_province
     * @return $this
     */
    public function setStateOrProvince(string $state_or_province)
    {
        $this->state_or_province = $state_or_province;
        return $this;
    }

    /**
     * @param string $postal_code
     * @return $this
     */
    public function setPostalCode(string $postal_code)
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * @param string $country_code
     * @return $this
     */
    public function setCountryCode(string $country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }

    /**
     * @param bool $residential
     * @return $this
     */
    public function setResidential(bool $residential)
    {
        $this->residential = $residential;
        return $this;
    }

    public function prepare(): array
    {
        $address = [];
        if (!empty($this->street_lines)) {
            $address['streetLines'] = $this->street_lines;
        }
        if (!empty($this->city)) {
            $address['city'] = $this->city;
        }
        if (!empty($this->state_or_province)) {
            $address['stateOrProvinceCode'] = $this->state_or_province;
        }
        if (!empty($this->postal_code)) {
            $address['postalCode'] = $this->postal_code;
        }
        if (!empty($this->country_code)) {
            $address['countryCode'] = $this->country_code;
        }
        if (!empty($this->residential)) {
            $address['residential'] = $this->residential;
        }

        return $address;
    }
}
