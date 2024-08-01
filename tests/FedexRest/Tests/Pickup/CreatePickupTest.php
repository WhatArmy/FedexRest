<?php declare(strict_types=1);

namespace FedexRest\Tests\Pickup;

use FedexRest\Authorization\Authorize;
use FedexRest\Entity\Address;
use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Exceptions\MissingAuthCredentialsException;
use FedexRest\Exceptions\MissingLineItemException;
use FedexRest\Services\Pickup\CreatePickup;
use FedexRest\Services\Pickup\Entity\Contact;
use FedexRest\Services\Pickup\Entity\OriginDetail;
use FedexRest\Services\Pickup\Entity\PickupLocation;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\Ship\Exceptions\MissingLabelException;
use FedexRest\Services\Ship\Exceptions\MissingLabelResponseOptionsException;
use FedexRest\Services\Ship\Exceptions\MissingShippingChargesPaymentException;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class CreatePickupTest extends TestCase
{
    protected Authorize $auth;

    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    /**
     * @throws MissingLabelResponseOptionsException
     * @throws MissingShippingChargesPaymentException
     * @throws MissingAuthCredentialsException
     * @throws MissingLineItemException
     * @throws MissingAccessTokenException
     * @throws MissingLabelException
     * @throws GuzzleException
     * @throws MissingAccountNumberException
     */
    public function testRequest()
    {
        $pickup = (new CreatePickup())
            ->setAccessToken((string)$this->auth->authorize()->access_token)
            ->setAssociatedAccountNumber(740561073)
            ->setOriginDetail(
                (new OriginDetail())->setPickupLocation(
                    (new PickupLocation())->setContact(
                        (new Contact())
                            ->setPersonName('Contact Name for Pickup')
                            ->setPhoneNumber('1234567890')

                    )->setAddress(
                        (new Address())
                            ->setStreetLines('10 Fedex Pkwy')
                            ->setCity('Collierville')
                            ->setStateOrProvince('TN')
                            ->setPostalCode('38017')
                            ->setCountryCode('US')
                    )
                )
                    ->setReadyDateTimestamp('2020-07-03T11:00:00Z')
                    ->setCustomerCloseTime('17:00:00')
            )
            ->setCarrierCode('FDXE');

        $request = $pickup->request();

        $this->assertObjectHasProperty('transactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $output = $request->output;
        $this->assertNotEmpty($output->pickupConfirmationCode);
    }

}
