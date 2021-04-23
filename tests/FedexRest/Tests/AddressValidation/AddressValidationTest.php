<?php

namespace FedexRest\Tests\AddressValidation;

use FedexRest\Authorization\Authorize;
use FedexRest\Entity\Address;
use FedexRest\Services\AddressValidation\AddressValidation;
use PHPUnit\Framework\TestCase;

class AddressValidationTest extends TestCase
{
    protected Authorize $auth;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->auth = (new Authorize)
            ->setClientId('l76ac1844c563048e582a791871f51f1f5')
            ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');
    }

    public function testValidateAddress()
    {
        $test = (new AddressValidation())
            ->setAddress(
                (new Address())
                    ->setCity('Irving')
                    ->setCountryCode('US')
                    ->setStateOrProvince('TX')
                    ->setPostalCode('75063-8659')
                    ->setStreetLines('7372 PARKRIDGE BLVD', 'APT 286')
            )
            ->setAccessToken($this->auth->authorize()->access_token)
            ->request();
        $this->assertObjectHasAttribute('transactionId', $test);
    }
}