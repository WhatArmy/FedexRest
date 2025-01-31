<?php

namespace FedexRest\Services\FreightLTL;

use FedexRest\Entity\Weight;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\Pickup\Entity\OriginDetail;
use FedexRest\Services\FreightLTL\Entity\FreightPickupDetail;
use FedexRest\Services\Pickup\Entity\PickupNotificationDetail;
use FedexRest\Services\FreightLTL\Exceptions\MissingOriginDetailException;
use FedexRest\Services\FreightLTL\Exceptions\MissingFreightPickupDetailException;
use FedexRest\Services\FreightLTL\Exceptions\MissingAssociatedAccountNumberException;

class CreateFreightLTLPickup extends AbstractRequest
{
    protected string $associatedAccountNumber = '';
    protected OriginDetail $originDetail;
    protected array $totalWeight = [];
    protected ?int $packageCount = null;
    protected ?string $remarks = null;
    protected ?string $countryRelationships = null;
    protected ?string $trackingNumber = null;
    protected ?string $commodityDescription = null;
    protected FreightPickupDetail $freightPickupDetail;
    protected ?int $oversizePackageCount = null;
    protected ?PickupNotificationDetail $pickupNotificationDetail = null;

    public function setApiEndpoint(): string
	{
		return '/pickup/v1/freight/pickups/';
	}

    /**
     * @param string $associatedAccountNumber
     * @return $this
     */
    public function setAssociatedAccountNumber(string $associatedAccountNumber): CreateFreightLTLPickup
    {
        $this->associatedAccountNumber = $associatedAccountNumber;
        return $this;
    }

    /**
     * @param OriginDetail $originDetail
     * @return $this
     */
    public function setOriginDetail(OriginDetail $originDetail): CreateFreightLTLPickup
    {
        $this->originDetail = $originDetail;
        return $this;
    }

    /**
     * @param string $associatedAccountNumber
     * @return $this
     */
    public function addTotalWeight(Weight $weight): CreateFreightLTLPickup
    {
        $this->totalWeight[] = $weight;
        return $this;
    }

    /**
     * @param int|null $packageCount
     * @return $this
     */
    public function setPackageCount(?int $packageCount): CreateFreightLTLPickup
    {
        $this->packageCount = $packageCount;
        return $this;
    }

    /**
     * @param string|null $remarks
     * @return $this
     */
    public function setRemarks(?string $remarks): CreateFreightLTLPickup
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param string|null $countryRelationships
     * @return $this
     */
    public function setCountryRelationships(?string $countryRelationships): CreateFreightLTLPickup
    {
        $this->countryRelationships = $countryRelationships;
        return $this;
    }

    /**
     * @param string|null $trackingNumber
     * @return $this
     */
    public function setTrackingNumber(?string $trackingNumber): CreateFreightLTLPickup
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @param string|null $commodityDescription
     * @return $this
     */
    public function setCommodityDescription(?string $commodityDescription): CreateFreightLTLPickup
    {
        $this->commodityDescription = $commodityDescription;
        return $this;
    }

    /**
     * @param FreightPickupDetail $freightPickupDetail
     * @return $this
     */
    public function setFreightPickupDetail(FreightPickupDetail $freightPickupDetail): CreateFreightLTLPickup
    {
        $this->freightPickupDetail = $freightPickupDetail;
        return $this;
    }

    /**
     * @param int|null $oversizePackageCount
     * @return $this
     */
    public function setOversizePackageCount(?int $oversizePackageCount): CreateFreightLTLPickup
    {
        $this->oversizePackageCount = $oversizePackageCount;
        return $this;
    }

    /**
     * @param PickupNotificationDetail|null $pickupNotificationDetail
     * @return $this
     */
    public function setPickupNotificationDetail(?PickupNotificationDetail $pickupNotificationDetail): CreateFreightLTLPickup
    {
        $this->pickupNotificationDetail = $pickupNotificationDetail;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'associatedAccountNumber' => [
                'value' => $this->associatedAccountNumber,
            ],
            'originDetail' => $this->originDetail->prepare(),
            'remarks' => $this->remarks,
            'freightPickupDetail' => $this->freightPickupDetail->prepare(),
        ];

        if(!empty($this->totalWeight)) {
            $data['totalWeight'] = array_map(function (Weight $weight) {
                return $weight->prepare();
            }, $this->totalWeight);
        }

        if(!empty($this->packageCount)){
            $data['packageCount'] = $this->packageCount;
        }

        if(!empty($this->remarks)){
            $data['remarks'] = $this->remarks;
        }

        if(!empty($this->countryRelationships)){
            $data['countryRelationships'] = $this->countryRelationships;
        }

        if(!empty($this->trackingNumber)){
            $data['trackingNumber'] = $this->trackingNumber;
        }

        if(!empty($this->commodityDescription)){
            $data['commodityDescription'] = $this->commodityDescription;
        }

        if(!empty($this->oversizePackageCount)){
            $data['oversizePackageCount'] = $this->oversizePackageCount;
        }

        if(!empty($this->pickupNotificationDetail)){
            $data['pickupNotificationDetail'] = $this->pickupNotificationDetail->prepare();
        }


        return $data;
    }

    public function request()
    {
        parent::request();

        if(empty($this->associatedAccountNumber)){
            throw new MissingAssociatedAccountNumberException('Associated Account Number is missing.');
        }

        if(!isset($this->originDetail)){
            throw new MissingOriginDetailException('Origin Detail is missing.');
        }

        if(!isset($this->freightPickupDetail)){
            throw new MissingFreightPickupDetailException('Freight Pickup Detail is missing.');
        }


        try {
            $query = $this->http_client->post($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => FALSE,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }        
    }
    
}
