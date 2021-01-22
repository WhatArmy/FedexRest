<?php


namespace FedexRest\Entity;


class Item
{
    public string $item_description = '';
    public ?Weight $weight;

    /**
     * @param  string  $item_description
     * @return Item
     */
    public function setItemDescription(string $item_description): Item
    {
        $this->item_description = $item_description;
        return $this;
    }

    /**
     * @param  Weight|null  $weight
     * @return Item
     */
    public function setWeight(?Weight $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }


}
