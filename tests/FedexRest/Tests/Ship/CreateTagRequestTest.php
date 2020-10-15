<?php declare(strict_types=1);


namespace FedexRest\Tests\Ship;


use FedexRest\Authorization\Authorize;
use FedexRest\Entity\Address;
use FedexRest\Entity\Person;
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

    public function testRequiredData()
    {
        $auth = (new Authorize)
            ->setClientId('l76ac1844c563048e582a791871f51f1f5')
            ->setClientSecret('f4ae9fc64c694b14af5ef3716a902a1b');

        $request = (new CreateTagRequest)
            ->setAccessToken($auth->authorize()->access_token)
            ->setAccountNumber(740561073)
            ->setRecipients(
                (new Person)->setPersonName('Lorem')
                    ->withAddress(
                        (new Address())
                            ->setCity('Boston')
                            ->setStreetLines('line 1', 'line 2')
                    ),
                (new Person)->setPersonName('Ipsum')
            )->setShipper(
                (new Person)->setPersonName('Ipsum')
            );


        $this->assertCount(2, $request->getRecipients());
        $this->assertObjectHasAttribute('personName', $request->getShipper());
    }
}
