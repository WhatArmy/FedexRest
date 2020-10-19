<?php


namespace FedexRest\Services;


interface RequestInterface
{
    /**
     * @param  string  $access_token
     * @return mixed
     */
    public function setAccessToken(string $access_token);

    /**
     * @return mixed
     */
    public function setApiEndpoint();

    /**
     * @return mixed
     */
    public function request();
}
