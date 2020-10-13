<?php declare(strict_types=1);

namespace FedexRest\Tests\TrackService;

use FedexRest\Authorization\Authorize;
use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Exceptions\MissingTrackingNumberException;
use FedexRest\Services\Track\TrackByTrackingNumberRequest;
use PHPUnit\Framework\TestCase;

class TrackByTrackingNumberRequestTest extends TestCase
{

    public function testSetApiEndpoint()
    {
        $request = new TrackByTrackingNumberRequest();

        $this->assertObjectHasAttribute('api_endpoint', $request);
        $this->assertEquals('/track/v1/trackingnumbers', $request->api_endpoint);
    }


    public function testProductionMode()
    {
        $request = (new TrackByTrackingNumberRequest())->useProduction();
        $this->assertObjectHasAttribute('productionMode', $request);
        $this->assertEquals(true, $request->productionMode);
        $this->assertEquals('https://apis.fedex.com', $request->getApiUri());
    }

    public function testMissingAuthCredentials()
    {

        try {
            (new TrackByTrackingNumberRequest())
                ->setTrackingNumber('020207021381215')
                ->response();
        } catch (MissingAccessTokenException $e) {
            $this->assertEquals('Authorization token is missing. Make sure it is included', $e->getMessage());
        }

    }

    public function testRawResponse()
    {
        $auth = (new Authorize)
            ->setClientId('l76ac1844c563048e582a791871f51f1f5')
            ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

        $response = (new TrackByTrackingNumberRequest())
            ->asRaw()
            ->setTrackingNumber('020207021381215')
            ->setAccessToken($auth->authorize()->access_token)->response();

        $this->assertObjectHasAttribute('headers', $response);
    }

    public function testMissingTrackingNumber()
    {

        try {
            $auth = (new Authorize)
                ->setClientId('l76ac1844c563048e582a791871f51f1f5')
                ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

            (new TrackByTrackingNumberRequest())
                ->setAccessToken($auth->authorize()->access_token)->response();
        } catch (MissingTrackingNumberException $e) {
            $this->assertEquals('Please enter at least one tracking number', $e->getMessage());
        }

    }
}
