<?php


namespace FedexRest\Services\Ship;


use FedexRest\Services\AbstractRequest;

class CreateTagRequest extends AbstractRequest
{

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
       // $request = $this->http_client->
    }

}
