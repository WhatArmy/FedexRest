<?php


namespace FedexRest\Services;


interface RequestInterface
{
    /**
     * @param $access_token
     * @return mixed
     */
    public function setAccessToken($access_token);

    /**
     * @return mixed
     */
    public function setApiEndpoint();

    /**
     * @return mixed
     */
    public function response();
}
