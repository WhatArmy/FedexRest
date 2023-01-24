<?php


namespace FedexRest\Tests\Entity;


use FedexRest\Entity\Address;
use FedexRest\Entity\Person;
use PHPUnit\Framework\TestCase;

class PersonEntityTest extends TestCase
{
    public function testPersonHasAttributes()
    {
        $person = (new Person())
            ->setPersonName('Sample Name')
            ->setCompanyName('Acme Corp')
            ->setPhoneNumber(1111111111)
            ->withAddress((new Address)
                ->setCity('Boston')->setStreetLines('test 1','test 2')
            );


        $this->assertObjectHasAttribute('personName', $person);
        $this->assertObjectHasAttribute('companyName', $person);
        $this->assertObjectHasAttribute('phoneNumber', $person);
        $this->assertObjectHasAttribute('city', $person->address);
        $this->assertEquals('Boston', $person->address->city);
        $this->assertCount(2, $person->address->street_lines);
    }
}
