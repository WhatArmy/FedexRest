<?php


namespace FedexRest\Services;


use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Traits\rawable;
use FedexRest\Traits\switchableEnv;
use GuzzleHttp\Client;


abstract class AbstractRequest implements RequestInterface
{
    use switchableEnv, rawable;

    public string $api_endpoint = '';
    protected string $access_token;
    protected Client $http_client;

    /**
     * AbstractRequest constructor.
     */
    public function __construct()
    {
        $this->api_endpoint = $this->setApiEndpoint();
    }

    /**
     * @param  string  $access_token
     * @return $this|mixed
     */
    public function setAccessToken(string $access_token)
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
     * @param $client_secret
     * @return $this|string
     */
    public function setClientSecret($client_secret)
    {
        $this->clientSecret = $client_secret;
        return $this;
    }

    public function request()
    {
        if (empty($this->access_token)) {
            throw new MissingAccessTokenException('Authorization token is missing. Make sure it is included');
        }
        $this->http_client = new Client([
            'headers' => [
                'Authorization' => "Bearer {$this->access_token}",
                'Content-Type' => 'application/json'
            ],
        ]);
    }
}
