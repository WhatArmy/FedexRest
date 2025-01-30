<?php

namespace FedexRest\Services\FreightLTL;

use FedexRest\Services\AbstractRequest;
use FedexRest\Services\FreightLTL\Exceptions\MissingReasonException;
use FedexRest\Services\FreightLTL\Exceptions\MissingContactNameException;
use FedexRest\Services\FreightLTL\Exceptions\MissingAssociatedAccountNumberException;
use FedexRest\Services\FreightLTL\Exceptions\MissingPickupConfirmationCodeException;

class CancelFreightLTLPickup extends AbstractRequest
{
    protected string $associatedAccountNumber = '';
    protected string $pickupConfirmationCode = '';
    protected ?string $remarks = null;
    protected string $reason = '';
    protected string $contactName = '';
    protected ?string $scheduledDate = null;

	public function setApiEndpoint(): string
	{
		return '/pickup/v1/freight/pickups/cancel/';
	}

    /**
     * @param string $associatedAccountNumber
     * @return $this
     */
    public function setAssociatedAccountNumber(string $associatedAccountNumber): CancelFreightLTLPickup
    {
        $this->associatedAccountNumber = $associatedAccountNumber;
        return $this;
    }

    /**
     * @param string $pickupConfirmationNumber
     * @return $this
     */
    public function setPickupConfirmationCode(string $pickupConfirmationCode): CancelFreightLTLPickup
    {
        $this->pickupConfirmationCode = $pickupConfirmationCode;
        return $this;
    }

    /**
     * @param string $remarks
     * @return $this
     */
    public function setRemarks(string $remarks): CancelFreightLTLPickup
    {
        $this->remarks = $remarks;
        return $this;
    }

    /**
     * @param string $reason
     * @return $this
     */
    public function setReason(string $reason): CancelFreightLTLPickup
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * @param string $contactName
     * @return $this
     */
    public function setContactName(string $contactName): CancelFreightLTLPickup
    {
        $this->contactName = $contactName;
        return $this;
    }

    /**
     * @param string $scheduledDate
     * @return $this
     */
    public function setScheduledDate(string $scheduledDate): CancelFreightLTLPickup
    {
        $this->scheduledDate = $scheduledDate;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
                'associatedAccountNumber' => 
                    [
                        'value' => $this->associatedAccountNumber
                    ],
                'pickupConfirmationCode' => $this->pickupConfirmationCode,
                'reason' => $this->reason,
                'contactName' => $this->contactName,
        ];

        if(!empty($this->remarks)){
            $data['remarks'] = $this->remarks;
        }

        if(!empty($this->scheduledDate)){
            $data['scheduledDate'] = $this->scheduledDate;
        }

        return $data;
    }

    /**
     * @throws MissingAssociatedAccountNumberException
     * @throws MissingPickupConfirmationCodeException
     * @throws MissingReasonException
     * @throws MissingContactNameException
     * @throws GuzzleException
     */
    public function request()
    {
        parent::request();

        if(empty($this->associatedAccountNumber)){
            throw new MissingAssociatedAccountNumberException('Associated Account Number is required.');
        }

        if(empty($this->pickupConfirmationCode)){
            throw new MissingPickupConfirmationCodeException('Pickup Confirmation Number is required.');
        }

        if(empty($this->reason)){
            throw new MissingReasonException('Reason is required.');
        }

        if(empty($this->contactName)){
            throw new MissingContactNameException('Contact Name is required.');
        }


        try {
            $query = $this->http_client->put($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => false,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}
