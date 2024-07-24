<?php

namespace FedexRest\Entity;

class CustomerReference
{
    public function __construct(
        public ?string $type = null, // One of the Type\CustomerReferenceType constants
        public string $value = '',
    ) {}

    public function setType(?string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;
        return $this;
    }

    public function prepare(): array {
        $data = [];
        if (!empty($this->type)) {
            $data['customerReferenceType'] = $this->type;
            $data['value'] = $this->value;
        }
        return $data;
    }


}
