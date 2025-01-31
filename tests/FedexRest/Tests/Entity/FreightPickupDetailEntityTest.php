<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Entity\Weight;
use FedexRest\Entity\Address;
use PHPUnit\Framework\TestCase;
use FedexRest\Entity\Dimensions;
use FedexRest\Services\Pickup\Entity\Contact;
use FedexRest\Services\Ship\Type\LinearUnits;
use FedexRest\Services\Ship\Type\WeightUnits;
use FedexRest\Services\FreightLTL\Entity\Billing;
use FedexRest\Services\FreightLTL\Entity\SubmittedBy;
use FedexRest\Services\FreightLTL\Entity\FreightPickupDetail;
use FedexRest\Services\FreightLTL\Entity\FreightPickupLineItem;

class FreightPickupDetailEntityTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $freightPickupDetail = (new FreightPickupDetail())
            ->setAccountNumber('123456789')
            ->setAccountNumberKey('123456789')
            ->setRole('SHIPPER')
            ->setPayment('SENDER')
            ->setUserMessage('This is a test message')
            ->setSubmittedBy(
                (new SubmittedBy())
                    ->setCompanyName('Test Company')
                    ->setPersonName('Test Person')
                    ->setPhoneNumber('1234567890')
                    ->setPhoneExtension('123')
                    ->setEmailAddress('abc@abc.com')
            )
            ->setLineItems(
                (new FreightPickupLineItem())
                    ->setTrackingNumber('123456789')
                    ->setService('FEDEX_FREIGHT_PRIORITY')
                    ->setTotalHandlingUnits(1)
                    ->setWeight((new Weight())
                        ->setValue(100)
                        ->setUnit('LB')
                    )
                    ->setDestination((new Address())
                        ->setStreetLines('1234 Main St')
                        ->setCity('Memphis')
                        ->setStateOrProvince('TN')
                        ->setPostalCode('38125')
                        ->setCountryCode('US')
                    )
                )
            ->setAlternateBilling(
                (new Billing())
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
                    ->setAccountNumber('123456789')
            );

        $this->assertObjectHasProperty('accountNumber', $freightPickupDetail);
        $this->assertObjectHasProperty('role', $freightPickupDetail);
        $this->assertObjectHasProperty('payment', $freightPickupDetail);
        $this->assertObjectHasProperty('submittedBy', $freightPickupDetail);
        $this->assertObjectHasProperty('lineItems', $freightPickupDetail);
        $this->assertObjectHasProperty('alternateBilling', $freightPickupDetail);
        $this->assertObjectHasProperty('userMessage', $freightPickupDetail);

        $freightPickupDetailPrepared = $freightPickupDetail->prepare();

        $this->assertEquals('123456789', $freightPickupDetailPrepared['accountNumber']['value']);
        $this->assertEquals('123456789', $freightPickupDetailPrepared['accountNumber']['key']);
        $this->assertEquals('SHIPPER', $freightPickupDetailPrepared['role']);
        $this->assertEquals('SENDER', $freightPickupDetailPrepared['payment']);
        $this->assertEquals('This is a test message', $freightPickupDetailPrepared['userMessage']);
        $this->assertEquals('Test Company', $freightPickupDetailPrepared['submittedBy']['companyName']);
        $this->assertEquals('Test Person', $freightPickupDetailPrepared['submittedBy']['personName']);
        $this->assertEquals('1234567890', $freightPickupDetailPrepared['submittedBy']['phoneNumber']);
        $this->assertEquals('123', $freightPickupDetailPrepared['submittedBy']['phoneExtension']);
        $this->assertEquals('abc@abc.com', $freightPickupDetailPrepared['submittedBy']['emailAddress']);
        $this->assertEquals('Harrison', $freightPickupDetailPrepared['alternateBilling']['address']['city']);
        $this->assertEquals('AR', $freightPickupDetailPrepared['alternateBilling']['address']['stateOrProvinceCode']);
        $this->assertEquals('72601', $freightPickupDetailPrepared['alternateBilling']['address']['postalCode']);
        $this->assertEquals('US', $freightPickupDetailPrepared['alternateBilling']['address']['countryCode']);
        $this->assertEquals(true, $freightPickupDetailPrepared['alternateBilling']['address']['residential']);
        $this->assertEquals('John Doe', $freightPickupDetailPrepared['alternateBilling']['contact']['personName']);
        $this->assertEquals('555-555-5555', $freightPickupDetailPrepared['alternateBilling']['contact']['phoneNumber']);
        $this->assertEquals('Company Name', $freightPickupDetailPrepared['alternateBilling']['contact']['companyName']);
        $this->assertEquals('123456789', $freightPickupDetailPrepared['alternateBilling']['accountNumber']);
    }
}
