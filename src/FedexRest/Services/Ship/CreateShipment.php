<?php

namespace FedexRest\Services\Ship;

use FedexRest\Entity\Item;
use FedexRest\Services\Ship\Entity\Label;
use FedexRest\Entity\Person;
use FedexRest\Services\Ship\Entity\ShipmentSpecialServices;
use FedexRest\Services\Ship\Entity\ShippingChargesPayment;
use FedexRest\Services\Ship\Entity\Value;
use FedexRest\Exceptions\MissingAccountNumberException;
use FedexRest\Services\Ship\Exceptions\MissingLabelException;
use FedexRest\Services\Ship\Exceptions\MissingLabelResponseOptionsException;
use FedexRest\Exceptions\MissingLineItemException;
use FedexRest\Services\Ship\Exceptions\MissingShippingChargesPaymentException;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\Ship\Type\LabelDocOptionType;

class CreateShipment extends AbstractRequest
{
    protected Person $shipper;
    protected array $recipients = [];
    protected Label $label;
    protected string $shipDatestamp = '';
    protected string $serviceType;
    protected string $packagingType = '';
    protected string $pickupType = '';
    protected int $accountNumber;
    protected array $lineItems = [];
    protected string $labelResponseOptions = '';
    protected ShipmentSpecialServices $shipmentSpecialServices;
    protected ShippingChargesPayment $shippingChargesPayment;
    protected string $mergeLabelDocOption = LabelDocOptionType::_LABELS_AND_DOCS;
    protected string $shipAction = '';
    protected string $processingOptionType = '';
    protected Value $totalDeclaredValue;
    protected string $recipientLocationNumber = '';
    protected int $totalWeight;
    protected Person $origin;
    protected bool $blockInsightVisibility = FALSE;
    protected bool $oneLabelAtATime = FALSE;
    protected string $preferredCurrency = '';
    protected int $totalPackageCount;

    /**
     * {@inheritDoc}
     */
    public function setApiEndpoint() {
        return '/ship/v1/shipments';
    }

    /**
     * @param Person $shipper
     * @return $this
     */
    public function setShipper(Person $shipper): CreateShipment {
        $this->shipper = $shipper;
        return $this;
    }

    /**
     * @return \FedexRest\Services\Ship\Entity\Person
     */
    public function getShipper(): Person
    {
        return $this->shipper;
    }

    /**
     * @param Person ...$recipients
     * @return $this
     */
    public function setRecipients(Person ...$recipients): CreateShipment {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return \FedexRest\Services\Ship\Entity\Person[]
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * @param string  $shipDatestamp
     * @return $this
     */
    public function setShipDatestamp(string $shipDatestamp): CreateShipment {
        $this->shipDatestamp = $shipDatestamp;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipDatestamp(): string
    {
        return $this->shipDatestamp;
    }

    /**
     * @param string  $serviceType
     * @return $this
     */
    public function setServiceType(string $serviceType): CreateShipment {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string  $packagingType
     * @return $this
     */
    public function setPackagingType(string $packagingType): CreateShipment {
        $this->packagingType = $packagingType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPackagingType(): string
    {
        return $this->packagingType;
    }

    /**
     * @param string  $pickupType
     * @return $this
     *   The shipment.
     */
    public function setPickupType(string $pickupType): CreateShipment {
        $this->pickupType = $pickupType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPickupType(): string
    {
        return $this->pickupType;
    }

    /**
     * @param  int  $accountNumber
     * @return $this
     */
    public function setAccountNumber(int $accountNumber): CreateShipment {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @param Item ...$lineItems
     * @return $this
     */
    public function setLineItems(Item ...$lineItems): CreateShipment {
        $this->lineItems = $lineItems;
        return $this;
    }


    /**
     * @return array
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @param Label $label
     * @return $this
     */
    public function setLabel(Label $label): CreateShipment {
        $this->label = $label;
        return $this;
    }


    /**
     * @return \FedexRest\Services\Ship\Entity\Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }

    /**
     * @param string  $labelResponseOptions
     *
     * @return $this
     */
    public function setLabelResponseOptions(string $labelResponseOptions): CreateShipment {
        $this->labelResponseOptions = $labelResponseOptions;
        return $this;
    }


    /**
     * @return string
     */
    public function getLabelResponseOptions(): string
    {
        return $this->labelResponseOptions;
    }

    /**
     * @param ShipmentSpecialServices  $shipmentSpecialServices
     * @return $this
     */
    public function setShipmentSpecialServices(ShipmentSpecialServices $shipmentSpecialServices): CreateShipment {
        $this->shipmentSpecialServices = $shipmentSpecialServices;
        return $this;
    }


    /**
     * @return \FedexRest\Services\Ship\Entity\ShipmentSpecialServices
     */
    public function getShipmentSpecialServices(): ShipmentSpecialServices
    {
        return $this->shipmentSpecialServices;
    }

    /**
     * @param ShippingChargesPayment  $shippingChargesPayment
     * @return $this
     */
    public function setShippingChargesPayment(ShippingChargesPayment $shippingChargesPayment): CreateShipment {
        $this->shippingChargesPayment = $shippingChargesPayment;
        return $this;
    }


    /**
     * @return \FedexRest\Services\Ship\Entity\ShippingChargesPayment
     */
    public function getShippingChargesPayment(): ShippingChargesPayment
    {
        return $this->shippingChargesPayment;
    }

    /**
     * @param string  $mergeLabelDocOption
     * @return $this
     */
    public function setMergeLabelDocOption(string $mergeLabelDocOption): CreateShipment
    {
        $this->mergeLabelDocOption = $mergeLabelDocOption;
        return $this;
    }

    /**
     * @return string
     */
    public function getMergeLabelDocOption(): string
    {
        return $this->mergeLabelDocOption;
    }

    /**
     * @param  string  $shipAction
     * @return $this
     */
    public function setShipAction(string $shipAction): CreateShipment
    {
        $this->shipAction = $shipAction;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipAction(): string
    {
        return $this->shipAction;
    }

    /**
     * @param  string  $processingOptionType
     * @return $this
     */
    public function setProcessingOptionType(string $processingOptionType): CreateShipment
    {
        $this->processingOptionType = $processingOptionType;
        return $this;
    }

    /**
     * @return string
     */
    public function getProcessingOptionType(): string
    {
        return $this->processingOptionType;
    }

    /**
     * @param  \FedexRest\Services\Ship\Entity\Value  $totalDeclaredValue
     *
     * @return $this
     */
    public function setTotalDeclaredValue(Value $totalDeclaredValue): CreateShipment
    {
        $this->totalDeclaredValue = $totalDeclaredValue;
        return $this;
    }

    /**
     * @return \FedexRest\Services\Ship\Entity\Value
     */
    public function getTotalDeclaredValue(): Value
    {
        return $this->totalDeclaredValue;
    }

    /**
     * @param  string  $recipientLocationNumber
     * @return $this
     */
    public function setRecipientLocationNumber(string $recipientLocationNumber): CreateShipment
    {
        $this->recipientLocationNumber = $recipientLocationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientLocationNumber(): string
    {
        return $this->recipientLocationNumber;
    }

    /**
     * @param  int  $totalWeight
     * @return $this
     */
    public function setTotalWeight(int $totalWeight): CreateShipment
    {
        $this->totalWeight = $totalWeight;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalWeight(): int
    {
        return $this->totalWeight;
    }

    /**
     * @param  \FedexRest\Entity\Person  $origin
     *
     * @return $this
     */
    public function setOrigin(Person $origin): CreateShipment
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @return \FedexRest\Entity\Person
     */
    public function getOrigin(): Person
    {
        return $this->origin;
    }

    /**
     * @param  bool  $blockInsightVisibility
     * @return $this
     */
    public function setBlockInsightVisibility(bool $blockInsightVisibility): CreateShipment
    {
        $this->blockInsightVisibility = $blockInsightVisibility;
        return $this;
    }

    /**
     * @return bool
     */
    public function getBlockInsightVisibility(): bool
    {
        return $this->blockInsightVisibility;
    }

    /**
     * @param  string  $preferredCurrency
     * @return \FedexRest\Services\Ship\CreateShipment
     */
    public function setPreferredCurrency(string $preferredCurrency): CreateShipment
    {
        $this->preferredCurrency = $preferredCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreferredCurrency(): string
    {
        return $this->preferredCurrency;
    }

    /**
     * @param  int  $totalPackageCount
     * @return \FedexRest\Services\Ship\CreateShipment
     */
    public function setTotalPackageCount(int $totalPackageCount): CreateShipment
    {
        $this->totalPackageCount = $totalPackageCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPackageCount(): int
    {
        return $this->totalPackageCount;
    }

    /**
     * @param  bool  $oneLabelAtATime
     * @return $this
     */
    public function setOneLabelAtATime(bool $oneLabelAtATime): CreateShipment
    {
        $this->oneLabelAtATime = $oneLabelAtATime;
        return $this;
    }

    /**
     * @return bool
     */
    public function getOneLabelAtATime(): bool
    {
        return $this->oneLabelAtATime;
    }

    /**
     * @return array
     */
    public function getRequestedShipment(): array {
        $recipients = [];
        $line_items = [];
        foreach ($this->recipients as $recipient) {
            $recipients[] = $recipient->prepare();
        }
        foreach ($this->lineItems as $line_item) {
            $line_items[] = $line_item->prepare();
        }
        $data = [
            'shipper' => $this->shipper->prepare(),
            'recipients' => $recipients,
            'shipDatestamp' => $this->shipDatestamp,
            'serviceType' => $this->serviceType,
            'packagingType' => $this->packagingType,
            'pickupType' => $this->pickupType,
            'blockInsightVisibility' => $this->blockInsightVisibility,
            'requestedPackageLineItems' => $line_items,
        ];
        if (!empty($this->shippingChargesPayment)) {
            $data ['shippingChargesPayment'] = $this->shippingChargesPayment->prepare();
        }
        if (!empty($this->label)) {
            $data ['labelSpecification'] = $this->label->prepare();
        }
        if (!empty($this->shipmentSpecialServices)) {
            $data['shipmentSpecialServices'] = $this->shipmentSpecialServices->prepare();
        }
        if (!empty($this->shippingChargesPayment)) {
            $data['shippingChargesPayment'] = $this->shippingChargesPayment->prepare();
        }
        if (!empty($this->totalDeclaredValue)) {
            $data['totalDeclaredValue'] = $this->totalDeclaredValue->prepare();
        }
        if (!empty($this->recipientLocationNumber)) {
            $data['recipientLocationNumber'] = $this->recipientLocationNumber;
        }
        if (!empty($this->totalWeight)) {
            $data['totalWeight'] = $this->totalWeight;
        }
        if (!empty($this->origin)) {
            $data['origin'] = $this->origin->prepare();
        }
        if (!empty($this->preferredCurrency)) {
            $data['preferredCurrency'] = $this->preferredCurrency;
        }
        if (!empty($this->totalPackageCount)) {
            $data['totalPackageCount'] = $this->totalPackageCount;
        }
        return $data;
    }

    public function prepare(): array {
        $data = [
            'requestedShipment' => $this->getRequestedShipment(),
            'mergeLabelDocOption' => $this->mergeLabelDocOption,
            'labelResponseOptions' => $this->labelResponseOptions,
            'oneLabelAtATime' => $this->oneLabelAtATime,
            'accountNumber' => [
                'value' => $this->accountNumber,
            ],
        ];
        if (!empty($this->shipAction)) {
            $data['shipAction'] = $this->shipAction;
        }
        if (!empty($this->processingOptionType)) {
            $data['processingOptionType'] = $this->processingOptionType;
        }
        return $data;
    }

    /**
     * @throws \FedexRest\Services\Ship\Exceptions\MissingLabelResponseOptionsException
     * @throws \FedexRest\Services\Ship\Exceptions\MissingShippingChargesPaymentException
     * @throws \FedexRest\Exceptions\MissingLineItemException
     * @throws \FedexRest\Exceptions\MissingAccessTokenException
     * @throws \FedexRest\Services\Ship\Exceptions\MissingLabelException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \FedexRest\Exceptions\MissingAccountNumberException
     */
    public function request() {
        parent::request();
        if (empty($this->accountNumber)) {
            throw new MissingAccountNumberException('The account number is required');
        }
        if (empty($this->lineItems)) {
            throw new MissingLineItemException('Line items are required');
        }
        if (empty($this->labelResponseOptions)) {
            throw new MissingLabelResponseOptionsException('Label Response Options are required');
        }
        if (empty($this->shippingChargesPayment)) {
            throw new MissingShippingChargesPaymentException('Shipping charges payment is required');
        }
        if (empty($this->label)) {
            throw new MissingLabelException('A label is required');
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
