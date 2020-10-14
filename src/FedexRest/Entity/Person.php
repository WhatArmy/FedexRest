<?php


namespace FedexRest\Entity;


class Person
{
    protected Address $address;
    protected string $personName;
    protected int $phoneNumber;

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
}
