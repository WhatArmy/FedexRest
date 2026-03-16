<?php

namespace FedexRest\Tests\FreightLTL;

use FedexRest\Entity\Address;
use PHPUnit\Framework\TestCase;
use FedexRest\Authorization\Authorize;
use FedexRest\Services\FreightLTL\RateFreightLTL;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\FreightLTL\Entity\RateFreightRequestedShipment;
use FedexRest\Services\FreightLTL\Entity\RateRequestControlParameters;
use FedexRest\Services\FreightLTL\Exceptions\MissingFreightRequestedShipment;

class RateFreightLTLTest extends TestCase
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
            $request = (new RateFreightLTL())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->request();

        } catch (MissingAccountNumberException $e) {
            $this->assertEquals('Account Number is missing.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testHasFreightRequestedShipment()
    {
        $request = NULL;
        try {
            $request = (new RateFreightLTL())
                ->setAccessToken((string) $this->auth->authorize()->access_token)
                ->setAccountNumber('510087503')
                ->request();

        } catch (MissingFreightRequestedShipment $e) {
            $this->assertEquals('Freight Requested Shipment is missing.', $e->getMessage());
        }
        $this->assertEmpty($request, 'The request did not fail as it should.');
    }

    public function testPrepare()
    {
        $request = (new RateFreightLTL())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setAccountNumber('510087503')
            ->setRateRequestControlParameters((new RateRequestControlParameters())
                ->setReturnTransitTimes(true)
                ->setServiceNeededOnRateFailure(true)
                ->setVariableOptions('FREIGHT_GUARANTEE')
                ->setRateSortOrder('SERVICENAMETRADITIONAL'))
            ->setFreightRequestedShipment((new RateFreightRequestedShipment())
                ->setShipperAddress((new Address())
                    ->setStreetLines(['1234 Main Street'])
                    ->setCity('Anytown')
                    ->setStateOrProvince('NC')
                    ->setPostalCode('12345')
                    ->setCountryCode('US')
                    ->setResidential(false))
                ->setRecipientAddress((new Address())
                    ->setStreetLines(['1234 Main Street'])
                    ->setCity('Anytown')
                    ->setStateOrProvince('NC')
                    ->setPostalCode('12345')
                    ->setCountryCode('US')
                    ->setResidential(false)));

        $prepared = $request->prepare();

        $this->assertIsArray($prepared);
        $this->assertArrayHasKey('accountNumber', $prepared);
        $this->assertArrayHasKey('rateRequestControlParameters', $prepared);
        $this->assertArrayHasKey('freightRequestedShipment', $prepared);
        $this->assertEquals('510087503', $prepared['accountNumber']['value']);
        $this->assertEquals([
            'returnTransitTimes' => true,
            'serviceNeededOnRateFailure' => true,
            'variableOptions' => 'FREIGHT_GUARANTEE',
            'rateSortOrder' => 'SERVICENAMETRADITIONAL'
        ], $prepared['rateRequestControlParameters']);

    }

    public function testRequest()
    {

    }
}
