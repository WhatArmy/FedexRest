<?php

namespace FedexRest\Services\TradeDocument\Entity;

class Document
{
    public string $workflowName;
    public string $name;
    public string $contentType;
    public Meta $meta;
    public ?string $carrierCode = null;

    public function setWorkflowName(string $workflowName): Document
    {
        $this->workflowName = $workflowName;
        return $this;
    }

    public function setName(string $name): Document
    {
        $this->name = $name;
        return $this;
    }

    public function setContentType(string $contentType): Document
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function setMeta(Meta $meta): Document
    {
        $this->meta = $meta;
        return $this;
    }

    public function setCarrierCode(string $carrierCode): Document
    {
        $this->carrierCode = $carrierCode;
        return $this;
    }

    public function prepare(): array
    {
        $data = [
            'workflowName' => $this->workflowName,
            'name' => $this->name,
            'contentType' => $this->contentType,
            'meta' => $this->meta->prepare(),
        ];
        if (!empty($this->carrierCode)) {
            $data['carrierCode'] = $this->carrierCode;
        }
        return $data;
    }
}