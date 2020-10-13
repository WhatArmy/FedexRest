<?php


namespace FedexRest\Services\Ship;


use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\AbstractRequest;

class CreateTagRequest extends AbstractRequest
{
    protected int $account_number;

    /**
     * @inheritDoc
     */
    public function setApiEndpoint()
    {
        return '/ship/v1/shipments/tag';
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

    public function response()
    {
        parent::response();
        if (empty($this->account_number)) {
            throw new MissingAccountNumberException('The account number is required');
        }
        $request = $this->http_client->post($this->getApiUri($this->api_endpoint), [
            'json' => [
                'accountNumber' => $this->account_number,
                'requestedShipment' => [
                    'shipper' => [],
                    'recipients' => [],
                    'pickupType' => '',
                    'serviceType' => '',
                    'packagingType' => '',
                    'shippingChargesPayment' => [
                        'paymentType' => '',
                        'payor' => [
                            'responsibleParty' => [
                                'accountNumber' => '',
                            ]
                        ],
                    ],
                    'labelSpecification' => [],
                    'requestedPackageLineItems' => [],
                    'pickupDetail' => [],
                ],
            ]
        ]);
    }

}
