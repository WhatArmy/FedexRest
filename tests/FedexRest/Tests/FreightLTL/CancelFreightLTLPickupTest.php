<?php

namespace FedexRest\Tests\FreightLTL;

use PHPUnit\Framework\TestCase;
use FedexRest\Authorization\Authorize;
use FedexRest\Services\FreightLTL\CancelFreightLTLPickup;
use FedexRest\Services\FreightLTL\Exceptions\MissingPickupConfirmationCodeException;
use FedexRest\Services\FreightLTL\Exceptions\MissingAssociatedAccountNumberException;

class CancelFreightLTLPickupTest extends TestCase
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
            $request = (new CancelFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->request();

        } catch (MissingAssociatedAccountNumberException $e) {
            $this->assertEquals('Associated Account Number is required.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasPickupConfirmationNumber()
    {
        $request = NULL;
        try {
            $request = (new CancelFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAssociatedAccountNumber('740561073')
                ->request();

        } catch (MissingPickupConfirmationCodeException $e) {
            $this->assertEquals('Pickup Confirmation Number is required.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasReason()
    {
        $request = NULL;
        try {
            $request = (new CancelFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAssociatedAccountNumber('740561073')
                ->setPickupConfirmationCode('20201007MEM628005')
                ->request();

        } catch (\Exception $e) {
            $this->assertEquals('Reason is required.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasContactName()
    {
        $request = NULL;
        try {
            $request = (new CancelFreightLTLPickup())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAssociatedAccountNumber('740561073')
                ->setPickupConfirmationCode('20201007MEM628005')
                ->setReason('No longer needed')
                ->request();

        } catch (\Exception $e) {
            $this->assertEquals('Contact Name is required.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testRequiredData()
    {
        $cancelFreightLTLPickup = (new CancelFreightLTLPickup())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber($associatedAccountNumber = '740561073')
            ->setPickupConfirmationCode($pickupConfimrationCode = '20201007MEM628005')
            ->setReason($reason = 'No longer needed')
            ->setContactName($ContactName = 'John Doe');
        
        $prepared = $cancelFreightLTLPickup->prepare();
        $this->assertEquals($associatedAccountNumber, $prepared['associatedAccountNumber']['value']);
        $this->assertEquals($pickupConfimrationCode, $prepared['pickupConfirmationCode']);
        $this->assertEquals($reason, $prepared['reason']);
        $this->assertEquals($ContactName, $prepared['contactName']);
    }

    public function testPrepare()
    {
        $request = (new CancelFreightLTLPickup())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber($associatedAccountNumber = '740561073')
            ->setPickupConfirmationCode($pickupConfimrationCode = '20201007MEM628005')
            ->setRemarks($remarks = 'No longer needed')
            ->setReason($reason = 'No longer needed')
            ->setContactName($ContactName = 'John Doe')
            ->setScheduledDate($scheduledDate = '2020-10-07');

        $prepared = $request->prepare();

        $this->assertEquals($associatedAccountNumber, $prepared['associatedAccountNumber']['value']);
        $this->assertEquals($pickupConfimrationCode, $prepared['pickupConfirmationCode']);
        $this->assertEquals($remarks, $prepared['remarks']);
        $this->assertEquals($reason, $prepared['reason']);
        $this->assertEquals($ContactName, $prepared['contactName']);
        $this->assertEquals($scheduledDate, $prepared['scheduledDate']);       
    }

    public function testRequest()
    {
        $request = (new CancelFreightLTLPickup())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber('740561073')
            ->setPickupConfirmationCode('XXXX1007MEM62XXXX')
            ->setReason('No longer needed')
            ->setContactName('John Doe')
            ->setScheduledDate('2020-10-07')
            ->request();
        var_dump($request);

        $this->assertObjectHasProperty('transactionId', $request);
        //As per FedEx Rep, Can Freight LTL Pickup will ALWAYS return in an error due to virtulizaed. They may change that in the future.
        //This is as far of testing we can do for Cancel. If something changes in future, additional asserts can be done below
        //$this->assertObjectNotHasProperty('errors', $request);
        //$this->assertObjectHasProperty('output', $request);
        //$this->assertObjectHasProperty('pickupConfirmationCode', $request->output);
        //$this->assertObjectHasProperty('cancelConfirmationMessage', $request->output);
    }


}
