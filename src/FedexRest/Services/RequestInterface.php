<?php


namespace FedexRest\Services;


interface RequestInterface
{
    /**
     * @return mixed
     */
    public function setApiEndpoint();

    /**
     * @return mixed
     */
    public function response();
}
