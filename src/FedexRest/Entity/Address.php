<?php


namespace FedexRest\Entity;


class Address
{
    protected array $street_lines;
    protected string $city;
    protected string $state_or_province;
    protected string $postal_code;
    protected string $country_code;

    /**
     * @param $street_lines
     * @return $this
     */
    public function setStreetLines(string $street_lines)
    {
        $this->street_lines = (array) $street_lines;
        return $this;
    }

    /**
     * @param  mixed  $city
     * @return Address
     */
    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param  mixed  $state_or_province
     * @return Address
     */
    public function setStateOrProvince(string $state_or_province)
    {
        $this->state_or_province = $state_or_province;
        return $this;
    }

    /**
     * @param  mixed  $postal_code
     * @return Address
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    /**
     * @param  mixed  $country_code
     * @return Address
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }
}
