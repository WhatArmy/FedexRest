<?php

namespace FedexRest\Tests\Ship;

use FedexRest\Authorization\Authorize;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Exceptions\MissingTrackingNumberException;
use FedexRest\Services\Ship\CancelShipment;
use PHPUnit\Framework\TestCase;

class CancelShipmentTest extends TestCase
{
    protected Authorize $auth;

    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    public function testHasAccountNumber()
    {
        $request = NULL;
        try {
            $request = (new CancelShipment())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->request();

        } catch (MissingAccountNumberException $e) {
            $this->assertEquals('The account number is required', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasTrackingNumber()
    {
        $request = NULL;
        try {
            $request = (new CancelShipment())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAccountNumber(740561073)
                ->request();

        } catch (MissingTrackingNumberException $e) {
            $this->assertEquals('The tracking number is required', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testPrepare()
    {
        $request = (new CancelShipment)
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAccountNumber($accountNumber = 740561073)
            ->setTrackingNumber($trackingNumber = 794953555571);

        $this->assertEquals($accountNumber, $request->prepare()['accountNumber']['value']);
        $this->assertEquals($trackingNumber, $request->prepare()['trackingNumber']);
    }

    public function testRequest()
    {
        $cancelShipment = (new CancelShipment)
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAccountNumber(740561073)
            ->setTrackingNumber(794953555571);

        $request = $cancelShipment->request();

        $this->assertObjectHasProperty('transactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $this->assertObjectHasProperty('cancelledShipment', $request->output);
        $this->assertObjectHasProperty('cancelledHistory', $request->output);
    }
}
