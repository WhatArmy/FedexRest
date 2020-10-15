<?php


namespace FedexRest\Services\Ship;


use FedexRest\Entity\Person;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\AbstractRequest;

class CreateTagRequest extends AbstractRequest
{
    protected int $account_number;
    protected Person $shipper;
    protected array $recipients;

    /**
     * @inheritDoc
     */
    public function setApiEndpoint()
    {
        return '/ship/v1/shipments/tag';
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @return Person
     */
    public function getShipper(): Person
    {
        return $this->shipper;
    }

    /**
     * @param  Person  $shipper
     * @return $this
     */
    public function setShipper(Person $shipper): CreateTagRequest
    {
        $this->shipper = $shipper;
        return $this;
    }

    /**
     * @param  Person  ...$recipients
     * @return $this
     */
    public function setRecipients(Person ...$recipients): CreateTagRequest
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @param  int  $account_number
     * @return $this
     */
    public function setAccountNumber(int $account_number): CreateTagRequest
    {
        $this->account_number = $account_number;
        return $this;
    }

    public function request()
    {
        parent::request();
        if (empty($this->account_number)) {
            throw new MissingAccountNumberException('The account number is required');
        }

//        $request = $this->http_client->post($this->getApiUri($this->api_endpoint), [
//            'json' => [
//                'accountNumber' => $this->account_number,
//                'requestedShipment' => [
//                    'shipper' => $this->shipper->prepare(),
//                    'recipients' => $this->recipients->prepare(),
//                    'pickupType' => '',
//                    'serviceType' => '',
//                    'packagingType' => '',
//                    'shippingChargesPayment' => [
//                        'paymentType' => '',
//                        'payor' => [
//                            'responsibleParty' => [
//                                'accountNumber' => '',
//                            ]
//                        ],
//                    ],
//                    'labelSpecification' => [],
//                    'requestedPackageLineItems' => [],
//                    'pickupDetail' => [],
//                ],
//            ]
//        ]);
    }

}
