<?php

namespace FedexRest\Entity;

class CustomerReference
{
    public string $type;
    public string $value;

    public function setType(string $type): CustomerReference
    {
        $this->type = $type;
        return $this;
    }

    public function setValue(string $value): CustomerReference
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