<?php declare(strict_types=1);

namespace FedexRest\Tests\TrackService;

use FedexRest\Services\Track\TrackByTrackingNumberRequest;
use PHPUnit\Framework\TestCase;

class TrackByTrackingNumberRequestTest extends TestCase
{

    public function testSetApiEndpoint()
    {
        $request = new TrackByTrackingNumberRequest();

        $this->assertObjectHasAttribute('apiEndpoint', $request);
        $this->assertEquals('/track/v1/trackingnumbers', $request->apiEndpoint);
    }


    public function testProductionMode()
    {
        $request = (new TrackByTrackingNumberRequest())->useProduction();
        $this->assertObjectHasAttribute('productionMode', $request);
        $this->assertEquals(true, $request->productionMode);
        $this->assertEquals('https://apis.fedex.com', $request->getUri());
    }
}
