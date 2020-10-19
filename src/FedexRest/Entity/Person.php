<?php


namespace FedexRest\Entity;


class Person
{
    public ?Address $address = null;
    public string $personName = '';
    public int $phoneNumber;

    /**
     * @param  mixed  $address
     * @return Person
     */
    public function withAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }


    /**
     * @param  mixed  $personName
     * @return Person
     */
    public function setPersonName(string $personName)
    {
        $this->personName = $personName;
        return $this;
    }

    /**
     * @param  mixed  $phoneNumber
     * @return Person
     */
    public function setPhoneNumber(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return array[]
     */
    public function prepare(): array
    {
        $data = [
            'contact' =>
                [
                    'personName' => $this->personName,
                    'phoneNumber' => $this->phoneNumber,
                ]
        ];

        if ($this->address != null) {
            $data['address'] = [
                'streetLines' => $this->address->street_lines,
                'city' => $this->address->city,
                'stateOrProvinceCode' => $this->address->state_or_province,
                'postalCode' => $this->address->postal_code,
                'countryCode' => $this->address->country_code,
            ];
        }
        return $data;
    }
}
