<?php

namespace FedexRest\Services\Pickup\Entity;

class AccountAddressOfRecord
{
    /** @var string[] */
    protected array $streetLines = [];
    protected ?string $city = null;
    protected ?string $stateOrProvinceCode = null;
    protected ?string $postalCode = null;
    protected ?string $countryCode = null;
    protected ?bool $residential = null;
    protected ?string $addressClassification = null;

    /**
     * @return array
     */
    public function getStreetLines(): array
    {
        return $this->streetLines;
    }

    /**
     * @param $streetLines
     * @return AccountAddressOfRecord
     */
    public function setStreetLines(...$streetLines): AccountAddressOfRecord
    {
        $this->streetLines = $streetLines;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return AccountAddressOfRecord
     */
    public function setCity(?string $city): AccountAddressOfRecord
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStateOrProvinceCode(): ?string
    {
        return $this->stateOrProvinceCode;
    }

    /**
     * @param string|null $stateOrProvinceCode
     * @return AccountAddressOfRecord
     */
    public function setStateOrProvinceCode(?string $stateOrProvinceCode): AccountAddressOfRecord
    {
        $this->stateOrProvinceCode = $stateOrProvinceCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     * @return AccountAddressOfRecord
     */
    public function setPostalCode(?string $postalCode): AccountAddressOfRecord
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return AccountAddressOfRecord
     */
    public function setCountryCode(?string $countryCode): AccountAddressOfRecord
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getResidential(): ?bool
    {
        return $this->residential;
    }

    /**
     * @param bool|null $residential
     * @return AccountAddressOfRecord
     */
    public function setResidential(?bool $residential): AccountAddressOfRecord
    {
        $this->residential = $residential;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressClassification(): ?string
    {
        return $this->addressClassification;
    }

    /**
     * @param string|null $addressClassification
     * @return AccountAddressOfRecord
     */
    public function setAddressClassification(?string $addressClassification): AccountAddressOfRecord
    {
        $this->addressClassification = $addressClassification;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'streetLines' => $this->streetLines,
        ];
        if (!empty($this->city)) {
            $data['city'] = $this->city;
        }
        if (!empty($this->stateOrProvinceCode)) {
            $data['stateOrProvinceCode'] = $this->stateOrProvinceCode;
        }
        if (!empty($this->postalCode)) {
            $data['postalCode'] = $this->postalCode;
        }
        if (!empty($this->countryCode)) {
            $data['countryCode'] = $this->countryCode;
        }
        if ($this->residential !== null) {
            $data['residential'] = $this->residential;
        }
        if (!empty($this->addressClassification)) {
            $data['addressClassification'] = $this->addressClassification;
        }
        return $data;
    }
}