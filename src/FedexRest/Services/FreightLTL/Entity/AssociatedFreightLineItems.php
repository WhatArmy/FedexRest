<?php

namespace FedexRest\Services\FreightLTL\Entity;

class AssociatedFreightLineItems
{
    protected string $id = '';

    /**
     * Set the value of id
     * @param string $id
     * @return  $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function prepare(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
