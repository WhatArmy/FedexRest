<?php

namespace FedexRest\Services\LocationSearch;

use FedexRest\Entity\Address;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\LocationSearch\Type\SearchCriterionType;

class FindLocations extends AbstractRequest
{
    protected ?Address $address;
    protected string $searchCriterion = SearchCriterionType::_ADDRESS;
    protected ?string $phoneNumber = null;
    protected bool $sameState = false;
    protected bool $sameCountry = false;
    protected ?float $long = null;
    protected ?float $lat = null;
    protected ?int $resultLimit = 20;

    /**
     * @param int|null $resultLimit
     * @return FindLocations
     */
    public function setResultLimit(?int $resultLimit): FindLocations
    {
        $this->resultLimit = $resultLimit;
        return $this;
    }


    public function setApiEndpoint(): string
    {
        return '/location/v1/locations';
    }

    /**
     * @param Address|null $address
     * @return FindLocations
     */
    public function setAddress(?Address $address): FindLocations
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param bool $sameState
     * @return FindLocations
     */
    public function sameState(bool $sameState): FindLocations
    {
        $this->sameState = $sameState;
        return $this;
    }

    /**
     * @param bool $sameCountry
     * @return FindLocations
     */
    public function sameCountry(bool $sameCountry): FindLocations
    {
        $this->sameCountry = $sameCountry;
        return $this;
    }


    /**
     * @param string|null $phoneNumber
     * @return FindLocations
     */
    public function setPhoneNumber(?string $phoneNumber): FindLocations
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }


    /**
     * @param string $searchCriterion
     * @return $this
     */
    public function setSearchCriterion(string $searchCriterion): FindLocations
    {
        $this->searchCriterion = $searchCriterion;
        return $this;
    }

    public function prepare(): array
    {
        return [
            'json' => [
                'locationSearchCriterion' => $this->searchCriterion,
                'locationsSummaryRequestControlParameters' => [
                    'maxResults' => $this->resultLimit
                ],
                'location' => [
                    'address' => $this->address->prepare(),
                    "longLat" => [
                        "latitude" => $this->lat,
                        "longitude" => $this->long
                    ]
                ],
                "phoneNumber" => $this->phoneNumber,
            ],
        ];
    }

    /**
     * @throws \FedexRest\Exceptions\MissingAccessTokenException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        parent::request();
        $query = $this->http_client->post($this->getApiUri($this->api_endpoint), $this->prepare());
        return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
    }
}
