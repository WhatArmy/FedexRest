<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Entity\Address;
use PHPUnit\Framework\TestCase;
use FedexRest\Services\Pickup\Entity\Contact;
use FedexRest\Services\FreightLTL\Entity\Billing;

class BillingEntityTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $billing = (new Billing())
            ->setAddress(
                (new Address())
                    ->setCity('Harrison')
                    ->setStateOrProvince('AR')
                    ->setPostalCode('72601')
                    ->setCountryCode('US')
                    ->setResidential(true)
            )
            ->setContact(
                (new Contact())
                    ->setPersonName('John Doe')
                    ->setPhoneNumber('555-555-5555')
                    ->setCompanyName('Company Name')
            )
            ->setAccountNumber('123456789');

        $this->assertObjectHasProperty('address', $billing);
        $this->assertObjectHasProperty('contact', $billing);
        $this->assertObjectHasProperty('accountNumber', $billing);

        $billingPrepared = $billing->prepare();
        $this->assertEquals('Harrison', $billingPrepared['address']['city']);
        $this->assertEquals('AR', $billingPrepared['address']['stateOrProvinceCode']);
        $this->assertEquals('72601', $billingPrepared['address']['postalCode']);
        $this->assertEquals('US', $billingPrepared['address']['countryCode']);
        $this->assertEquals(true, $billingPrepared['address']['residential']);
        $this->assertEquals('John Doe', $billingPrepared['contact']['personName']);
        $this->assertEquals('555-555-5555', $billingPrepared['contact']['phoneNumber']);
        $this->assertEquals('Company Name', $billingPrepared['contact']['companyName']);
        $this->assertEquals('123456789', $billingPrepared['accountNumber']);
        
    }

}
