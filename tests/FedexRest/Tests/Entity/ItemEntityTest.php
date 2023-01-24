<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Entity\Dimensions;
use FedexRest\Entity\Item;
use FedexRest\Entity\Weight;
use FedexRest\Services\Ship\Type\LinearUnits;
use FedexRest\Services\Ship\Type\WeightUnits;
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
                    ->setUnit(WeightUnits::_POUND)
            )
            ->setDimensions(
                (new Dimensions())
                    ->setUnits(LinearUnits::_INCH)
                    ->setHeight(12)
                    ->setWidth(12)
                    ->setLength(12)
            );
        $this->assertObjectHasAttribute('itemDescription', $item);
        $this->assertObjectHasAttribute('dimensions', $item);
        $this->assertObjectHasAttribute('weight', $item);
        $test_item = $item->prepare();
        $this->assertEquals(1, $test_item['weight']['value']);
        $this->assertEquals(WeightUnits::_POUND, $test_item['weight']['units']);
        $this->assertEquals(12, $test_item['dimensions']['height']);
        $this->assertEquals(12, $test_item['dimensions']['width']);
        $this->assertEquals(12, $test_item['dimensions']['length']);
        $this->assertEquals(LinearUnits::_INCH, $test_item['dimensions']['units']);
    }
}
