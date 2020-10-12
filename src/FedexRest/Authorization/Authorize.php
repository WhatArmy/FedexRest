<?php


namespace FedexRest\Authorization;


use FedexRest\Traits\switchableEnv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Authorize
{
    use switchableEnv;

    private string $clientId;
    private string $clientSecret;

    /**
     * Authorize constructor.
     * @param  string  $userId
     * @param  string  $userSecret
     */
    public function __construct(string $userId, string $userSecret)
    {
        $this->clientId = $userId;
        $this->clientSecret = $userSecret;
    }


    public function authorize()
    {
        $httpClient = new Client();
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
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }
}
