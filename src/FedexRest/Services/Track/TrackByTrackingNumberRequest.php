<?php


namespace FedexRest\Services\Track;


use FedexRest\Services\AbstractRequest;

class TrackByTrackingNumberRequest extends AbstractRequest
{

    /**
     * @return mixed|string
     */
    public function setApiEndpoint()
    {
        return '/track/v1/trackingnumbers';
    }

    public function response()
    {
        //
    }
}
