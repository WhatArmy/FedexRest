<?php

namespace FedexRest\Services\TradeDocument\Entity;

class ImageDocument
{
    public string $referenceId;
    public string $name;
    public string $contentType;
    public Rule $rules;
    public ImageMeta $meta;

    public function setReferenceId(string $referenceId): ImageDocument
    {
        $this->referenceId = $referenceId;
        return $this;
    }
    public function setName(string $name): ImageDocument
    {
        $this->name = $name;
        return $this;
    }

    public function setContentType(string $contentType): ImageDocument
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function setMeta(ImageMeta $meta): ImageDocument
    {
        $this->meta = $meta;
        return $this;
    }

    public function setRules(Rule $rule): ImageDocument
    {
        $this->rules = $rule;
        return $this;
    }

    public function prepare(): array
    {
        return [
            'document' => [
                'referenceId' => $this->referenceId,
                'name' => $this->name,
                'contentType' => $this->contentType,
                'meta' => $this->meta->prepare(),
            ],
            'rules' => $this->rules->prepare(),
        ];
    }
}