<?php

namespace FedexRest\Tests\FreightLTL;

use PHPUnit\Framework\TestCase;
use FedexRest\Authorization\Authorize;

class ShipFreightLTLTest extends TestCase
{
    protected Authorize $auth;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    public function testPrepare()
    {
        
    }

    public function testRequest()
    {

    }
}
