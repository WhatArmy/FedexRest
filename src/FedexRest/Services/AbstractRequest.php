<?php


namespace FedexRest\Services;


use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Traits\switchableEnv;


abstract class AbstractRequest implements RequestInterface
{
    use switchableEnv;

    public string $api_endpoint = '';
    protected string $access_token;

    /**
     * AbstractRequest constructor.
     */
    public function __construct()
    {
        $this->api_endpoint = $this->setApiEndpoint();
    }

    /**
     * @param $access_token
     * @return $this
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
        return $this;
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

    public function response()
    {
        if(empty($this->access_token)){
            throw new MissingAccessTokenException('Authorization token is missing. Make sure it is included');
        }
    }
}
