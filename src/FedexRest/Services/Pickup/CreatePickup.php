<?php

namespace FedexRest\Services\Pickup;

use FedexRest\Entity\Weight;
use FedexRest\Services\Pickup\Entity\AccountAddressOfRecord;
use FedexRest\Services\Pickup\Entity\ExpressFreightDetail;
use FedexRest\Services\Pickup\Entity\OriginDetail;
use FedexRest\Services\Pickup\Entity\PickupNotificationDetail;
use FedexRest\Services\AbstractRequest;

class CreatePickup extends AbstractRequest
{
    protected ?string $associatedAccountNumber = null;
    protected OriginDetail $originDetail;
    protected ?string $associatedAccountNumberType = null;
    protected ?Weight $totalWeight = null;
    protected ?int $packageCount = null;
    protected ?string $carrierCode = null;
    protected ?AccountAddressOfRecord $accountAddressOfRecord = null;
    protected ?string $remarks = null;
    protected ?string $countryRelationships = null;
    protected ?string $pickupType = null;
    protected ?string $trackingNumber = null;
    protected ?string $commodityDescription = null;
    protected ?ExpressFreightDetail $expressFreightDetail = null;
    protected ?int $oversizePackageCount = null;
    protected ?PickupNotificationDetail $pickupNotificationDetail = null;

    /**
     * @return string|null
     */
    public function getAssociatedAccountNumber(): ?string
    {
        return $this->associatedAccountNumber;
    }

    /**
     * @param string|null $associatedAccountNumber
     * @return CreatePickup
     */
    public function setAssociatedAccountNumber(?string $associatedAccountNumber): CreatePickup
    {
        $this->associatedAccountNumber = $associatedAccountNumber;
        return $this;
    }

    /**
     * @return OriginDetail
     */
    public function getOriginDetail(): OriginDetail
    {
        return $this->originDetail;
    }

    /**
     * @param OriginDetail $originDetail
     * @return CreatePickup
     */
    public function setOriginDetail(OriginDetail $originDetail): CreatePickup
    {
        $this->originDetail = $originDetail;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAssociatedAccountNumberType(): ?string
    {
        return $this->associatedAccountNumberType;
    }

    /**
     * @param string|null $associatedAccountNumberType
     * @return CreatePickup
     */
    public function setAssociatedAccountNumberType(?string $associatedAccountNumberType): CreatePickup
    {
        $this->associatedAccountNumberType = $associatedAccountNumberType;
        return $this;
    }

    /**
     * @return Weight|null
     */
    public function getTotalWeight(): ?Weight
    {
        return $this->totalWeight;
    }

    /**
     * @param Weight|null $totalWeight
     * @return CreatePickup
     */
    public function setTotalWeight(?Weight $totalWeight): CreatePickup
    {
        $this->totalWeight = $totalWeight;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPackageCount(): ?int
    {
        return $this->packageCount;
    }

    /**
     * @param int|null $packageCount
     * @return CreatePickup
     */
    public function setPackageCount(?int $packageCount): CreatePickup
    {
        $this->packageCount = $packageCount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCarrierCode(): ?string
    {
        return $this->carrierCode;
    }

    /**
     * @param string|null $carrierCode
     * @return CreatePickup
     */
    public function setCarrierCode(?string $carrierCode): CreatePickup
    {
        $this->carrierCode = $carrierCode;
        return $this;
    }

    /**
     * @return AccountAddressOfRecord|null
     */
    public function getAccountAddressOfRecord(): ?AccountAddressOfRecord
    {
        return $this->accountAddressOfRecord;
    }

    /**
     * @param AccountAddressOfRecord|null $accountAddressOfRecord
     * @return CreatePickup
     */
    public function setAccountAddressOfRecord(?AccountAddressOfRecord $accountAddressOfRecord): CreatePickup
    {
        $this->accountAddressOfRecord = $accountAddressOfRecord;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    /**
     * @param string|null $remarks
     * @return CreatePickup
     */
    public function setRemarks(?string $remarks): CreatePickup
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryRelationships(): ?string
    {
        return $this->countryRelationships;
    }

    /**
     * @param string|null $countryRelationships
     * @return CreatePickup
     */
    public function setCountryRelationships(?string $countryRelationships): CreatePickup
    {
        $this->countryRelationships = $countryRelationships;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPickupType(): ?string
    {
        return $this->pickupType;
    }

    /**
     * @param string|null $pickupType
     * @return CreatePickup
     */
    public function setPickupType(?string $pickupType): CreatePickup
    {
        $this->pickupType = $pickupType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * @param string|null $trackingNumber
     * @return CreatePickup
     */
    public function setTrackingNumber(?string $trackingNumber): CreatePickup
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommodityDescription(): ?string
    {
        return $this->commodityDescription;
    }

    /**
     * @param string|null $commodityDescription
     * @return CreatePickup
     */
    public function setCommodityDescription(?string $commodityDescription): CreatePickup
    {
        $this->commodityDescription = $commodityDescription;
        return $this;
    }

    /**
     * @return ExpressFreightDetail|null
     */
    public function getExpressFreightDetail(): ?ExpressFreightDetail
    {
        return $this->expressFreightDetail;
    }

    /**
     * @param ExpressFreightDetail|null $expressFreightDetail
     * @return CreatePickup
     */
    public function setExpressFreightDetail(?ExpressFreightDetail $expressFreightDetail): CreatePickup
    {
        $this->expressFreightDetail = $expressFreightDetail;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOversizePackageCount(): ?int
    {
        return $this->oversizePackageCount;
    }

    /**
     * @param int|null $oversizePackageCount
     * @return CreatePickup
     */
    public function setOversizePackageCount(?int $oversizePackageCount): CreatePickup
    {
        $this->oversizePackageCount = $oversizePackageCount;
        return $this;
    }

    /**
     * @return PickupNotificationDetail|null
     */
    public function getPickupNotificationDetail(): ?PickupNotificationDetail
    {
        return $this->pickupNotificationDetail;
    }

    /**
     * @param PickupNotificationDetail|null $pickupNotificationDetail
     * @return CreatePickup
     */
    public function setPickupNotificationDetail(?PickupNotificationDetail $pickupNotificationDetail): CreatePickup
    {
        $this->pickupNotificationDetail = $pickupNotificationDetail;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setApiEndpoint() {
        return '/pickup/v1/pickups';
    }

    public function prepare(): array {
        $data = [
            'associatedAccountNumber' => [
                'value' => $this->associatedAccountNumber,
            ],
            'originDetail' => $this->originDetail->prepare(),
            'carrierCode' => $this->carrierCode,
        ];
        if (!empty($this->associatedAccountNumberType)) {
            $data['associatedAccountNumberType'] = $this->associatedAccountNumberType;
        }
        if (!empty($this->totalWeight)) {
            $data['totalWeight'] = $this->totalWeight->prepare();
        }
        if (!empty($this->packageCount)) {
            $data['packageCount'] = $this->packageCount;
        }
        if (!empty($this->carrierCode)) {
            $data['carrierCode'] = $this->carrierCode;
        }
        if (!empty($this->accountAddressOfRecord)) {
            $data['accountAddressOfRecord'] = $this->accountAddressOfRecord->prepare();
        }
        if (!empty($this->remarks)) {
            $data['remarks'] = $this->remarks;
        }
        if (!empty($this->countryRelationships)) {
            $data['countryRelationships'] = $this->countryRelationships;
        }
        if (!empty($this->pickupType)) {
            $data['pickupType'] = $this->pickupType;
        }
        if (!empty($this->trackingNumber)) {
            $data['trackingNumber'] = $this->trackingNumber;
        }
        if (!empty($this->commodityDescription)) {
            $data['commodityDescription'] = $this->commodityDescription;
        }
        if (!empty($this->expressFreightDetail)) {
            $data['expressFreightDetail'] = $this->expressFreightDetail->prepare();
        }
        if (!empty($this->oversizePackageCount)) {
            $data['oversizePackageCount'] = $this->oversizePackageCount;
        }
        if (!empty($this->pickupNotificationDetail)) {
            $data['pickupNotificationDetail'] = $this->pickupNotificationDetail->prepare();
        }
        return $data;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface|string|void
     * @throws \FedexRest\Exceptions\MissingAccessTokenException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request() {
        parent::request();
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
