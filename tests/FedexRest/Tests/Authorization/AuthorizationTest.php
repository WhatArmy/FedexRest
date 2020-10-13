<?php declare(strict_types=1);

namespace FedexRest\Tests\Authorization;

use FedexRest\Authorization\Authorize;
use FedexRest\Exceptions\MissingAuthCredentialsException;
use PHPUnit\Framework\TestCase;

class AuthorizationTest extends TestCase
{

    public function testAuth()
    {
        $auth = (new Authorize)
            ->setClientId('l76ac1844c563048e582a791871f51f1f5')
            ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

        $this->assertObjectHasAttribute('access_token', $auth->authorize());
    }

    public function testAuthRaw()
    {
        $auth = (new Authorize)
            ->asRaw()
            ->setClientId('l76ac1844c563048e582a791871f51f1f5')
            ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

        $this->assertObjectHasAttribute('headers', $auth->authorize());
    }

    public function testMissingCredentials()
    {
        try {
            (new Authorize)->authorize();
        } catch (MissingAuthCredentialsException $e) {
            $this->assertEquals('Please provide auth credentials', $e->getMessage());
        }
    }
}
