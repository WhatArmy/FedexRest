<?php

namespace FedexRest\Tests\Pickup;

use FedexRest\Authorization\Authorize;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Exceptions\MissingTrackingNumberException;
use FedexRest\Services\Pickup\CancelPickup;
use FedexRest\Services\Ship\CancelShipment;
use PHPUnit\Framework\TestCase;

class CancelPickupTest extends TestCase
{
    protected Authorize $auth;

    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    public function testRequest()
    {
        $request = (new CancelPickup())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber(740561073)
            ->setPickupConfirmationCode('1')
            ->setCarrierCode('FDXE')
            ->setScheduledDate('2020-07-03')
            ->setLocation('NQAA');

        $request = $request->request();

        $this->assertObjectHasProperty('transactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $output = $request->output;
        $this->assertNotEmpty($output->pickupConfirmationCode);
        $this->assertEquals('Requested pickup has been cancelled Successfully.', $output->cancelConfirmationMessage);
    }
}
