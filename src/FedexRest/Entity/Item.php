<?php

namespace FedexRest\Entity;

class Item
{
    public string $itemDescription = '';
    public ?Weight $weight;

    /**
     * @param  string  $itemDescription
     * @return Item
     */
    public function setItemDescription(string $itemDescription): Item
    {
        $this->itemDescription = $itemDescription;
        return $this;
    }

    /**
     * @param  Weight|null  $weight
     * @return $this
     */
    public function setWeight(?Weight $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    public function prepare(): array
    {
        return [
            [
                'itemDescription' => $this->itemDescription,
                'weight' => [
                    'units' => $this->weight->unit,
                    'value' => $this->weight->value,
                ],
            ]
        ];
    }


}
