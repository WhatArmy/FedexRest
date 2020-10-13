<?php


namespace FedexRest\Authorization;


use FedexRest\Exceptions\MissingAuthCredentialsException;
use FedexRest\Traits\rawable;
use FedexRest\Traits\switchableEnv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Authorize
{
    use switchableEnv, rawable;

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
     * @throws MissingAuthCredentialsException
     * @throws GuzzleException
     */
    public function authorize()
    {
        $httpClient = new Client();
        if (isset($this->clientId) && isset($this->clientSecret)) {
            try {
                $query = $httpClient->request('POST', $this->getApiUri('/oauth/token'), [
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
                    return json_decode(($this->raw === true) ? $query : $query->getBody()->getContents());
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            throw new MissingAuthCredentialsException('Please provide auth credentials');
        }
    }
}
