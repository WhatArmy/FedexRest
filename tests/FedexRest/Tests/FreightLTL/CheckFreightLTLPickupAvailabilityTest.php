<?php

namespace FedexRest\Tests\FreightLTL;

use FedexRest\Entity\Weight;
use FedexRest\Entity\Address;
use PHPUnit\Framework\TestCase;
use FedexRest\Entity\Dimensions;
use FedexRest\Authorization\Authorize;
use FedexRest\Services\Ship\Type\SubPackagingType;
use FedexRest\Services\Ship\Type\ShipmentSpecialServiceType;
use FedexRest\Services\FreightLTL\Entity\FreightDirectDetail;
use FedexRest\Services\FreightLTL\Entity\FreightDirectDataDetails;
use FedexRest\Services\FreightLTL\CheckFreightLTLPickupAvailability;
use FedexRest\Services\FreightLTL\Exceptions\MissingFreightPickupDetailException;

class CheckFreightLTLPickupAvailabilityTest extends TestCase
{
    protected Authorize $auth;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    public function testHasPickupAddress()
    {
        $request = NULL;
        try {
            $request = (new CheckFreightLTLPickupAvailability())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->request();

        } catch (MissingFreightPickupDetailException $e) {
            $this->assertEquals('Pickup Address is required.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testPrepare()
    {
        $request = (new CheckFreightLTLPickupAvailability())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setPickupAddress((new Address())
                ->setStreetLines('1234 Main St')
                ->setCity('Memphis')
                ->setStateOrProvince('TN')
                ->setPostalCode('38120')
                ->setCountryCode('US')
                ->setResidential(true)
            )
            ->setPackageReadyTime('09:00')
            ->setCustomerCloseTime('17:00')
            ->setServiceType('FEDEX_FREIGHT_PRIORITY')
            ->setWeight((new Weight())
                ->setUnit('LB')
                ->setValue(200)
            )
            ->setPackagingType(SubPackagingType::_PALLET)
            ->setDimensions((new Dimensions())
                ->setLength(48)
                ->setWidth(40)
                ->setHeight(30)
                ->setUnits('IN')
            )
            ->setFreightGuaranteeTime('10:00')
            ->setFreightDirectDetail((new FreightDirectDetail())
                ->setFreightDirectDataDetails((new FreightDirectDataDetails())
                        ->setType('BASIC')
                        ->setTransportationType('PICKUP')
                        ->setEmailAddress('abc@abc.com')
                        ->addPhoneNumber('9015551234', 'MOBILE')
                    )
                )
            ->setSpecialServiceTypes(ShipmentSpecialServiceType::_FREIGHT_GUARANTEE)
            ->setDispatchDate(date('Y-m-d'))
            ->setNumberOfBusinessDays(3);

        $prepared = $request->prepare();

        $this->assertEquals('1234 Main St', $prepared['pickupAddress']['streetLines'][0]);
        $this->assertEquals('Memphis', $prepared['pickupAddress']['city']);
        $this->assertEquals('TN', $prepared['pickupAddress']['stateOrProvinceCode']);
        $this->assertEquals('38120', $prepared['pickupAddress']['postalCode']);
        $this->assertEquals('US', $prepared['pickupAddress']['countryCode']);
        $this->assertEquals(true, $prepared['pickupAddress']['residential']);
        $this->assertEquals('09:00', $prepared['packageReadyTime']);
        $this->assertEquals('17:00', $prepared['customerCloseTime']);
        $this->assertEquals('FEDEX_FREIGHT_PRIORITY', $prepared['shipmentAttributes']['serviceType']);
        $this->assertEquals('LB', $prepared['shipmentAttributes']['weight']['units']);
        $this->assertEquals(200, $prepared['shipmentAttributes']['weight']['value']);
        $this->assertEquals('PALLET', $prepared['shipmentAttributes']['packagingType']);
        $this->assertEquals(48, $prepared['shipmentAttributes']['dimensions']['length']);
        $this->assertEquals(40, $prepared['shipmentAttributes']['dimensions']['width']);
        $this->assertEquals(30, $prepared['shipmentAttributes']['dimensions']['height']);
        $this->assertEquals('IN', $prepared['shipmentAttributes']['dimensions']['units']);
        $this->assertEquals('10:00', $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightGuaranteeDetail']['time']);
        $this->assertEquals('BASIC', $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightDirectDetail']['freightDirectDataDetails'][0]['type']);
        $this->assertEquals('PICKUP', $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightDirectDetail']['freightDirectDataDetails'][0]['transportationType']);
        $this->assertEquals('abc@abc.com', $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightDirectDetail']['freightDirectDataDetails'][0]['emailAddress']);
        $this->assertEquals('9015551234', $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightDirectDetail']['freightDirectDataDetails'][0]['phoneNumberDetails'][0]['phoneNumber']);
        $this->assertEquals('MOBILE', $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['freightDirectDetail']['freightDirectDataDetails'][0]['phoneNumberDetails'][0]['phoneNumberType']);
        $this->assertEquals(ShipmentSpecialServiceType::_FREIGHT_GUARANTEE, $prepared['freightPickupSpecialServiceDetail']['shipmentSpecialServicesRequested']['specialServiceTypes'][0]);
        $this->assertEquals(date('Y-m-d'), $prepared['dispatchDate']);
        $this->assertEquals(3, $prepared['numberOfBusinessDays']);

    }

    public function testRequest()
    {
        $request = (new CheckFreightLTLPickupAvailability())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setPickupAddress((new Address())
                ->setStreetLines('1234 Main St')
                ->setCity('Memphis')
                ->setStateOrProvince('TN')
                ->setPostalCode('38120')
                ->setCountryCode('US')
                ->setResidential(true)
            )
            ->setPackageReadyTime('09:00')
            ->setCustomerCloseTime('17:00')
            ->setServiceType('FEDEX_FREIGHT_PRIORITY')
            ->setWeight((new Weight())
                ->setUnit('LB')
                ->setValue(200)
            )
            ->setPackagingType(SubPackagingType::_PALLET)
            ->setDimensions((new Dimensions())
                ->setLength(48)
                ->setWidth(40)
                ->setHeight(30)
                ->setUnits('IN')
            )
            ->setFreightGuaranteeTime('10:00')
            ->setFreightDirectDetail((new FreightDirectDetail())
                ->setFreightDirectDataDetails((new FreightDirectDataDetails())
                        ->setType('BASIC')
                        ->setTransportationType('PICKUP')
                        ->setEmailAddress('abc@abc.com')
                        ->addPhoneNumber('9015551234', 'MOBILE')
                    )
                )
            ->setSpecialServiceTypes(ShipmentSpecialServiceType::_FREIGHT_GUARANTEE)
            ->setDispatchDate(date('Y-m-d'))
            ->setNumberOfBusinessDays(3)
            ->request();

        $this->assertObjectHasProperty('transactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $this->assertObjectHasProperty('closeTime', $request->output);
        $this->assertObjectHasProperty('closeTimeType', $request->output);
        $this->assertObjectHasProperty('localTime', $request->output);
        $this->assertObjectHasProperty('options', $request->output);
        $this->assertIsArray($request->output->options);
    }

}
