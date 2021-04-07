<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Entity\Item;
use FedexRest\Entity\Weight;
use PHPUnit\Framework\TestCase;

class ItemEntityTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $item = (new Item())
            ->setItemDescription('lorem Ipsum')
            ->setWeight(
                (new Weight())
                    ->setValue(1)
                    ->setUnit('LB')
            );
        $this->assertObjectHasAttribute('itemDescription', $item);
        $this->assertObjectHasAttribute('weight', $item);
    }
}
