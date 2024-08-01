<?php

namespace FedexRest\Services\Pickup\Entity;

class PickupNotificationDetail
{

    /**
     * @var EmailDetail[]
     */
    protected array $emailDetails = [];
    protected ?string $format = null;
    protected ?string $userMessage = null;

    /**
     * @return array
     */
    public function getEmailDetails(): array
    {
        return $this->emailDetails;
    }

    /**
     * @param array $emailDetails
     * @return PickupNotificationDetail
     */
    public function setEmailDetails(array $emailDetails): PickupNotificationDetail
    {
        $this->emailDetails = $emailDetails;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param string|null $format
     * @return PickupNotificationDetail
     */
    public function setFormat(?string $format): PickupNotificationDetail
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserMessage(): ?string
    {
        return $this->userMessage;
    }

    /**
     * @param string|null $userMessage
     * @return PickupNotificationDetail
     */
    public function setUserMessage(?string $userMessage): PickupNotificationDetail
    {
        $this->userMessage = $userMessage;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'emailDetails' => [],
        ];
        foreach ($this->emailDetails as $detail) {
            $data['emailDetails'][] = $detail->prepare();
        }
        if (!empty($this->format)) {
            $data['format'] = $this->format;
        }
        if (!empty($this->userMessage)) {
            $data['userMessage'] = $this->userMessage;
        }
        return $data;
    }
}