<?php

namespace FedexRest\Services\FreightLTL\Entity;

class ContentRecord
{
    protected ?string $itemNumber = null;
    protected ?string $receivedQuantity = null;
    protected ?string $description = null;
    protected ?string $partNumber = null;

    /**
     * Set the value of itemNumber
     * @param string|null $itemNumber
     * @return  $this
     */
    public function setItemNumber(?string $itemNumber): self
    {
        $this->itemNumber = $itemNumber;

        return $this;
    }

    /**
     * Set the value of receivedQuantity
     * @param string|null $receivedQuantity
     * @return  $this
     */
    public function setReceivedQuantity(?string $receivedQuantity): self
    {
        $this->receivedQuantity = $receivedQuantity;

        return $this;
    }
    /**
     * Set the value of description
     * @param string|null $description
     * @return  $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of partNumber
     * @param string|null $partNumber
     * @return  $this
     */
    public function setPartNumber(?string $partNumber): self
    {
        $this->partNumber = $partNumber;

        return $this;
    }

    public function prepare(): array
    {
        return [
            'itemNumber' => $this->itemNumber,
            'receivedQuantity' => $this->receivedQuantity,
            'description' => $this->description,
            'partNumber' => $this->partNumber,
        ];
    }
}
