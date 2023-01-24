<?php


namespace FedexRest\Entity;


class Person
{
    public ?Address $address = null;
    public string $personName = '';
    public int $phoneNumber;
    public string $companyName = '';

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
     * @param  string  $phoneNumber
     * @return $this
     */
    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @param  string  $companyName
     * @return $this
     */
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return array[]
     */
    public function prepare(): array
    {
        $data = [];
        if (!empty($this->personName)) {
            $data['contact']['personName'] = $this->personName;
        }
        if (!empty($this->phoneNumber)) {
            $data['contact']['phoneNumber'] = $this->phoneNumber;
        }
        if (!empty($this->company_name)) {
            $data['contact']['companyName'] = $this->company_name;
        }

        if ($this->address != null) {
            $data['address'] = $this->address->prepare();
        }
        return $data;
    }
}
