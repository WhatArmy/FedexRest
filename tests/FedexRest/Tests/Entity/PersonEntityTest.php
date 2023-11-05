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


        $this->assertObjectHasProperty('personName', $person);
        $this->assertObjectHasProperty('companyName', $person);
        $this->assertObjectHasProperty('phoneNumber', $person);
        $this->assertObjectHasProperty('city', $person->address);
        $this->assertEquals('Boston', $person->address->city);
        $this->assertCount(2, $person->address->street_lines);
    }
}
