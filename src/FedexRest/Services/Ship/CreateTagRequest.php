<?php


namespace FedexRest\Services\Ship;


use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\AbstractRequest;

class CreateTagRequest extends AbstractRequest
{
    protected string $account_number;

    /**
     * @param  string  $account_number
     * @return CreateTagRequest
     */
    public function setAccountNumber(string $account_number): CreateTagRequest
    {
        $this->account_number = $account_number;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setApiEndpoint()
    {
        return '/ship/v1/shipments/tag';
    }


    public function response()
    {
        parent::response();
        if (empty($this->account_number)) {
            throw new MissingAccountNumberException('The account number is required');
        }
        $request = $this->http_client->post($this->getApiUri($this->api_endpoint), []);
    }

}
