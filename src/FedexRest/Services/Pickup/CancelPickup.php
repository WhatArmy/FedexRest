<?php

namespace FedexRest\Services\Pickup;

use FedexRest\Services\AbstractRequest;
use FedexRest\Services\Pickup\Entity\AccountAddressOfRecord;

class CancelPickup extends AbstractRequest
{

    protected int $associatedAccountNumber;
    protected string $pickupConfirmationCode;
    protected ?string $remarks = null;
    protected ?string $carrierCode = null;
    protected ?AccountAddressOfRecord $accountAddressOfRecord = null;
    /** 2019-10-15 */
    protected string $scheduledDate;
    protected ?string $location = null;

    /**
     * @return int
     */
    public function getAssociatedAccountNumber(): int
    {
        return $this->associatedAccountNumber;
    }

    /**
     * @param int $associatedAccountNumber
     * @return CancelPickup
     */
    public function setAssociatedAccountNumber(int $associatedAccountNumber): CancelPickup
    {
        $this->associatedAccountNumber = $associatedAccountNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickupConfirmationCode(): string
    {
        return $this->pickupConfirmationCode;
    }

    /**
     * @param string $pickupConfirmationCode
     * @return CancelPickup
     */
    public function setPickupConfirmationCode(string $pickupConfirmationCode): CancelPickup
    {
        $this->pickupConfirmationCode = $pickupConfirmationCode;
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
     * @return CancelPickup
     */
    public function setRemarks(?string $remarks): CancelPickup
    {
        $this->remarks = $remarks;
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
     * @return CancelPickup
     */
    public function setCarrierCode(?string $carrierCode): CancelPickup
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
     * @return CancelPickup
     */
    public function setAccountAddressOfRecord(?AccountAddressOfRecord $accountAddressOfRecord): CancelPickup
    {
        $this->accountAddressOfRecord = $accountAddressOfRecord;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheduledDate(): string
    {
        return $this->scheduledDate;
    }

    /**
     * @param string $scheduledDate
     * @return CancelPickup
     */
    public function setScheduledDate(string $scheduledDate): CancelPickup
    {
        $this->scheduledDate = $scheduledDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     * @return CancelPickup
     */
    public function setLocation(?string $location): CancelPickup
    {
        $this->location = $location;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'associatedAccountNumber' => [
                'value' => $this->associatedAccountNumber,
            ],
            'pickupConfirmationCode' => $this->pickupConfirmationCode,
            'scheduledDate' => $this->scheduledDate,
        ];
        if (!empty($this->remarks)) {
            $data['remarks'] = $this->remarks;
        }
        if (!empty($this->carrierCode)) {
            $data['carrierCode'] = $this->carrierCode;
        }
        if (!empty($this->accountAddressOfRecord)) {
            $data['accountAddressOfRecord'] = $this->accountAddressOfRecord->prepare();
        }
        if (!empty($this->location)) {
            $data['location'] = $this->location;
        }
        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function setApiEndpoint() {
        return '/pickup/v1/pickups/cancel';
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface|string|void
     * @throws \FedexRest\Exceptions\MissingAccessTokenException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request() {
        parent::request();
        try {
            $query = $this->http_client->put($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => FALSE,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}