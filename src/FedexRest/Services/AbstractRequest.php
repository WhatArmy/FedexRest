<?php


namespace FedexRest\Services;


use FedexRest\Traits\switchableEnv;

abstract class AbstractRequest implements RequestInterface
{
    use switchableEnv;

    public string $apiEndpoint = '';

    /**
     * AbstractRequest constructor.
     */
    public function __construct()
    {
        $this->apiEndpoint = $this->setApiEndpoint();
    }

    /**
     * @param $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @param $clientSecret
     * @return $this|string
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
}
