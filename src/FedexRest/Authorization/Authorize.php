<?php


namespace FedexRest\Authorization;


use FedexRest\Exceptions\MissingAuthCredentialsException;
use FedexRest\Traits\switchableEnv;
use GuzzleHttp\Client;

class Authorize
{
    use switchableEnv;

    private string $clientId;
    private string $clientSecret;

    /**
     * @param  string  $clientId
     * @return Authorize
     */
    public function setClientId(string $clientId): Authorize
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @param  string  $clientSecret
     * @return Authorize
     */
    public function setClientSecret(string $clientSecret): Authorize
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }


    /**
     * @return mixed|string
     */
    public function authorize()
    {
        $httpClient = new Client();
        if (isset($this->clientId) && isset($this->clientSecret)) {
            try {
                $query = $httpClient->request('POST', $this->getUri().'/oauth/token', [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                    ]
                ]);
                if ($query->getStatusCode() === 200) {
                    return json_decode($query->getBody()->getContents());
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new MissingAuthCredentialsException('Please provide auth credentials');
        }
    }
}
