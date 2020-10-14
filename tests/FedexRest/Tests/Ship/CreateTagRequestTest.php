<?php declare(strict_types=1);


namespace FedexRest\Tests\Ship;


use FedexRest\Authorization\Authorize;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\Ship\CreateTagRequest;
use PHPUnit\Framework\TestCase;

class CreateTagRequestTest extends TestCase
{

    public function testHasAccountNumber()
    {
        try {
            $auth = (new Authorize)
                ->setClientId('l76ac1844c563048e582a791871f51f1f5')
                ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

            $request = (new CreateTagRequest)
                ->setAccessToken($auth->authorize()->access_token)
                ->request();

        } catch (MissingAccountNumberException $e) {
            $this->assertEquals('The account number is required', $e->getMessage());
        }
    }

    public function testSome()
    {
        $auth = (new Authorize)
            ->setClientId('l76ac1844c563048e582a791871f51f1f5')
            ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

        $request = (new CreateTagRequest)
            ->setAccessToken($auth->authorize()->access_token)
            ->setAccountNumber(740561073);


        var_dump($request);
        die();
    }
}
