<?php

namespace FedexRest\Entity;

class EmailNotificationRecipient
{
    protected string $name;
    protected string $emailAddress;
    protected string $emailNotificationRecipientType;
    protected string $notificationFormatType = 'TEXT';
    protected string $notificationType = 'EMAIL';
    protected string $locale = 'en_US';
    protected array $notificationEventType = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): static
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    public function getEmailNotificationRecipientType(): string
    {
        return $this->emailNotificationRecipientType;
    }

    /**
     * "BROKER" "OTHER" "RECIPIENT" "SHIPPER" "THIRD_PARTY"
     */
    public function setEmailNotificationRecipientType(string $emailNotificationRecipientType): static
    {
        $this->emailNotificationRecipientType = $emailNotificationRecipientType;

        return $this;
    }

    /**
     * "HTML" "TEXT"
     */
    public function getNotificationFormatType(): string
    {
        return $this->notificationFormatType;
    }

    public function setNotificationFormatType(string $notificationFormatType): static
    {
        $this->notificationFormatType = $notificationFormatType;

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = $locale;

        return $this;
    }

    public function getNotificationEventType(): array
    {
        return $this->notificationEventType;
    }

    /**
     * @see NotificationEventType::class
     */
    public function setNotificationEventType(string ...$notificationEventType): static
    {
        $this->notificationEventType = $notificationEventType;

        return $this;
    }

    public function prepare(): array
    {
        return [
            'name' => $this->name,
            'emailAddress' => $this->emailAddress,
            'emailNotificationRecipientType' => $this->emailNotificationRecipientType,
            'notificationFormatType' => $this->notificationFormatType,
            'notificationType' => $this->notificationType,
            'locale' => $this->locale,
            'notificationEventType' => $this->notificationEventType,
        ];
    }

}
