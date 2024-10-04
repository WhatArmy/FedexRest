<?php

namespace FedexRest\Services\Pickup\Entity;

class PickupNotificationDetail
{

    /**
     * @var EmailAddress[]
     */
    protected array $emailAddresses = [];
    protected ?string $format = null;
    protected ?string $userMessage = null;

    /**
     * @return EmailAddress[]
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * @param EmailAddress[] $emailAddresses
     * @return PickupNotificationDetail
     */
    public function setEmailAddresses(array $emailAddresses): PickupNotificationDetail
    {
        $this->emailAddresses = $emailAddresses;
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
        foreach ($this->emailAddresses as $emailAddress) {
            $data['emailDetails'][] = $emailAddress->prepare();
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