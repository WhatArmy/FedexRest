<?php

namespace FedexRest\Services\Ship\Entity;

use FedexRest\Entity\EmailNotificationRecipient;

class EmailNotificationDetail
{
    protected string $aggregationType = 'PER_SHIPMENT';

    protected string $personalMessage;

    protected array $emailNotificationRecipients;

    public function getPersonalMessage(): string
    {
        return $this->personalMessage;
    }

    public function setPersonalMessage(string $personalMessage): static
    {
        $this->personalMessage = $personalMessage;

        return $this;
    }

    public function getAggregationType(): string
    {
        return $this->aggregationType;
    }

    // "PER_PACKAGE" "PER_SHIPMENT"
    public function setAggregationType(string $aggregationType): static
    {
        $this->aggregationType = $aggregationType;

        return $this;
    }

    public function getEmailNotificationRecipients(): array
    {
        return $this->emailNotificationRecipients;
    }

    public function setEmailNotificationRecipients(array $emailNotificationRecipients): static
    {
        $this->emailNotificationRecipients = $emailNotificationRecipients;

        return $this;
    }

    private function prepareEmailNotificationRecipients(): array
    {
        $emailNotificationRecipients = [];
        /** @var EmailNotificationRecipient $emailNotificationRecipient */
        foreach ($this->emailNotificationRecipients as $emailNotificationRecipient) {
            $emailNotificationRecipients[] = $emailNotificationRecipient->prepare();
        }

        return $emailNotificationRecipients;
    }

    public function prepare(): array
    {
        $data = [
            'aggregationType' => $this->aggregationType,
            'emailNotificationRecipients' => $this->prepareEmailNotificationRecipients(),
        ];

        if (!empty($this->personalMessage)) {
            $data['personalMessage'] = $this->personalMessage;
        }

        return $data;
    }
}
