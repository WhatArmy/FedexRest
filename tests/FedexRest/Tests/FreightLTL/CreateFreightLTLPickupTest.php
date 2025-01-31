<?php

namespace FedexRest\Tests\FreightLTL;

use FedexRest\Entity\Item;
use FedexRest\Entity\Weight;
use FedexRest\Entity\Address;
use PHPUnit\Framework\TestCase;
use FedexRest\Authorization\Authorize;
use FedexRest\Services\Pickup\Entity\Contact;
use FedexRest\Services\Pickup\Entity\EmailAddress;
use FedexRest\Services\Pickup\Entity\OriginDetail;
use FedexRest\Services\Pickup\Entity\PickupLocation;
use FedexRest\Services\FreightLTL\CreateFreightLTLPickup;
use FedexRest\Services\Ship\Entity\EmailNotificationDetail;
use FedexRest\Services\FreightLTL\Entity\FreightPickupDetail;
use FedexRest\Services\FreightLTL\Entity\FreightPickupLineItem;
use FedexRest\Services\Pickup\Entity\PickupNotificationDetail;
use FedexRest\Services\FreightLTL\Exceptions\MissingOriginDetailException;
use FedexRest\Services\FreightLTL\Exceptions\MissingFreightPickupDetailException;
use FedexRest\Services\FreightLTL\Exceptions\MissingAssociatedAccountNumberException;

class CreateFreightLTLPickupTest extends TestCase
{
    protected Authorize $auth;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    public function testHasAssociatedAccountNumber()
    {
        $request = NULL;
        try {
            $request = (new CreateFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->request();

        } catch (MissingAssociatedAccountNumberException $e) {
            $this->assertEquals('Associated Account Number is missing.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasOriginDetail()
    {
        $request = NULL;
        try {
            $request = (new CreateFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAssociatedAccountNumber('740561073')
                ->request();

        } catch (MissingOriginDetailException $e) {
            $this->assertEquals('Origin Detail is missing.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasFreightPickupDetail()
    {
        $request = NULL;
        try {
            $request = (new CreateFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAssociatedAccountNumber('740561073')
                ->setOriginDetail(new OriginDetail())
                ->request();
        } catch (MissingFreightPickupDetailException $e) {
            $this->assertEquals('Freight Pickup Detail is missing.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testRequiredData()
    {
        $createFreightLTLPickup = (new CreateFreightLTLPickup())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber($associatedAccountNumber = '740561073')
            ->setOriginDetail((new OriginDetail())
                ->setPickupLocation((new PickupLocation())
                    ->setAddress((new Address())
                        ->setStreetLines('1234 Main St')
                        ->setCity('Memphis')
                        ->setStateOrProvince('TN')
                        ->setPostalCode('38125')
                        ->setCountryCode('US')
                    )
                    ->setContact((new Contact())
                        ->setPersonName('John Doe')
                        ->setPhoneNumber('9015551234')
                    )
                )
                ->setReadyDateTimestamp('2021-10-07T08:00:00')
                ->setCustomerCloseTime('2021-10-07T08:00:00')
            )
            ->setFreightPickupDetail(new FreightPickupDetail());

        $prepared = $createFreightLTLPickup->prepare();
        $this->assertArrayHasKey('originDetail', $prepared);
        $this->assertArrayHasKey('freightPickupDetail', $prepared);

        $this->assertEquals($associatedAccountNumber, $prepared['associatedAccountNumber']['value']);
        $this->assertEquals('1234 Main St', $prepared['originDetail']['pickupLocation']['address']['streetLines'][0]);
        $this->assertEquals('Memphis', $prepared['originDetail']['pickupLocation']['address']['city']);
        $this->assertEquals('TN', $prepared['originDetail']['pickupLocation']['address']['stateOrProvinceCode']);
        $this->assertEquals('38125', $prepared['originDetail']['pickupLocation']['address']['postalCode']);
        $this->assertEquals('US', $prepared['originDetail']['pickupLocation']['address']['countryCode']);
        $this->assertEquals('John Doe', $prepared['originDetail']['pickupLocation']['contact']['personName']);
        $this->assertEquals('9015551234', $prepared['originDetail']['pickupLocation']['contact']['phoneNumber']);
        $this->assertEquals('2021-10-07T08:00:00', $prepared['originDetail']['readyDateTimestamp']);
        $this->assertEquals('2021-10-07T08:00:00', $prepared['originDetail']['customerCloseTime']);


    }

    public function testPrepare()
    {
        $createFreightLTLPickup = (new CreateFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAssociatedAccountNumber($associatedAccountNumber = '740561073')
                ->setOriginDetail((new OriginDetail())
                    ->setPickupLocation((new PickupLocation())
                        ->setAddress((new Address())
                            ->setStreetLines('1234 Main St')
                            ->setCity('Memphis')
                            ->setStateOrProvince('TN')
                            ->setPostalCode('38125')
                            ->setCountryCode('US')
                        )
                        ->setContact((new Contact())
                            ->setPersonName('John Doe')
                            ->setPhoneNumber('9015551234')
                        )
                    )
                    ->setReadyDateTimestamp('2021-10-07T08:00:00')
                    ->setCustomerCloseTime('2021-10-07T08:00:00')
                )
                ->addTotalWeight((new Weight())
                    ->setValue(100)
                    ->setUnit('LB')
                )
                ->setPackageCount(1)
                ->setRemarks('Some Remarks')
                ->setCountryRelationships('DOMESTIC')
                ->setTrackingNumber('123456789')
                ->setCommodityDescription('Some Commodity Description')
                ->setFreightPickupDetail(new FreightPickupDetail())
                ->setOversizePackageCount(1)
                ->setPickupNotificationDetail((new PickupNotificationDetail())
                    ->setEmailAddresses([
                        (new EmailAddress())
                            ->setAddress('abc@abc.com')
                            ->setLocale('en_US')    
                        ])
                    ->setFormat('HTML')
                    ->setUserMessage('Some User Message')
            );          


            $prepared = $createFreightLTLPickup->prepare();
            $this->assertArrayHasKey('originDetail', $prepared);
            $this->assertArrayHasKey('freightPickupDetail', $prepared);

            $this->assertEquals($associatedAccountNumber, $prepared['associatedAccountNumber']['value']);
            $this->assertEquals('1234 Main St', $prepared['originDetail']['pickupLocation']['address']['streetLines'][0]);
            $this->assertEquals('Memphis', $prepared['originDetail']['pickupLocation']['address']['city']);
            $this->assertEquals('TN', $prepared['originDetail']['pickupLocation']['address']['stateOrProvinceCode']);
            $this->assertEquals('38125', $prepared['originDetail']['pickupLocation']['address']['postalCode']);
            $this->assertEquals('US', $prepared['originDetail']['pickupLocation']['address']['countryCode']);
            $this->assertEquals('John Doe', $prepared['originDetail']['pickupLocation']['contact']['personName']);
            $this->assertEquals('9015551234', $prepared['originDetail']['pickupLocation']['contact']['phoneNumber']);
            $this->assertEquals('2021-10-07T08:00:00', $prepared['originDetail']['readyDateTimestamp']);
            $this->assertEquals('2021-10-07T08:00:00', $prepared['originDetail']['customerCloseTime']);
            $this->assertEquals(100, $prepared['totalWeight'][0]['value']);
            $this->assertEquals('LB', $prepared['totalWeight'][0]['units']);
            $this->assertEquals(1, $prepared['packageCount']);
            $this->assertEquals('Some Remarks', $prepared['remarks']);
            $this->assertEquals('DOMESTIC', $prepared['countryRelationships']);
            $this->assertEquals('123456789', $prepared['trackingNumber']);
            $this->assertEquals('Some Commodity Description', $prepared['commodityDescription']);
            $this->assertEquals(1, $prepared['oversizePackageCount']);
            $this->assertEquals('abc@abc.com', $prepared['pickupNotificationDetail']['emailDetails'][0]['address']);
            $this->assertEquals('en_US', $prepared['pickupNotificationDetail']['emailDetails'][0]['locale']);
            $this->assertEquals('HTML', $prepared['pickupNotificationDetail']['format']);
            $this->assertEquals('Some User Message', $prepared['pickupNotificationDetail']['userMessage']);

    }

    public function testRequest()
    {
        $nextDayforPickup = date('Y-m-d', strtotime('+2 weekdays')) . 'T08:00:00Z';
        $request = (new CreateFreightLTLPickup())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber('740561073')
            ->setOriginDetail((new OriginDetail())
                ->setPickupLocation((new PickupLocation())
                    ->setAddress((new Address())
                        ->setStreetLines('1234 Main St')
                        ->setCity('Memphis')
                        ->setStateOrProvince('TN')
                        ->setPostalCode('38125')
                        ->setCountryCode('US')
                    )
                    ->setContact((new Contact())
                        ->setCompanyName('Company Name')
                        ->setPersonName('John Doe')
                        ->setPhoneNumber('9015551234')
                    )
                )
                ->setReadyDateTimestamp($nextDayforPickup)
                ->setCustomerCloseTime('18:00:00')
            )
            ->setFreightPickupDetail((new FreightPickupDetail())
                ->setRole('SHIPPER')
                ->setPayment('SENDER')
                ->setLineItems( (new FreightPickupLineItem())
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
            )
            ->setOversizePackageCount(1)
            ->setPickupNotificationDetail((new PickupNotificationDetail())
                ->setEmailAddresses([
                    (new EmailAddress())
                        ->setAddress('abc@abc.com')
                        ->setLocale('en_US')
                    ])
                ->setFormat('HTML')
                ->setUserMessage('Some User Message')
                );
        $request = $request->request();

        $this->assertObjectHasProperty('transactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $this->assertObjectHasProperty('pickupConfirmationCode', $request->output);
    }
}
