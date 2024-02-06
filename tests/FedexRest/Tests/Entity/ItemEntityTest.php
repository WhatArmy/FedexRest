<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Entity\DangerousGoodsDetail;
use FedexRest\Entity\Dimensions;
use FedexRest\Entity\Item;
use FedexRest\Entity\PackageSpecialServicesRequested;
use FedexRest\Entity\Weight;
use FedexRest\Services\Ship\Entity\Value;
use FedexRest\Services\Ship\Type\DangerousGoodsAccessibilityType;
use FedexRest\Services\Ship\Type\LinearUnits;
use FedexRest\Services\Ship\Type\SubPackagingType;
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
            )
            ->setGroupPackageCount(2)
            ->setSequenceNumber(1)
            ->setSubPackagingType(SubPackagingType::_BAG)
            ->setDeclaredValue((new Value())->setAmount(100)->setCurrency('USD'))
            ->setPackageSpecialServices(
              (new PackageSpecialServicesRequested())
                ->setDangerousGoodsDetail(
                  (new DangerousGoodsDetail())
                    ->setAccessibility(DangerousGoodsAccessibilityType::_ACCESSIBLE)
                )
            );
        $this->assertObjectHasProperty('itemDescription', $item);
        $this->assertObjectHasProperty('dimensions', $item);
        $this->assertObjectHasProperty('weight', $item);
        $this->assertObjectHasProperty('groupPackageCount', $item);
        $this->assertObjectHasProperty('sequenceNumber', $item);
        $this->assertObjectHasProperty('subPackagingType', $item);
        $this->assertObjectHasProperty('declaredValue', $item);
        $this->assertObjectHasProperty('packageSpecialServices', $item);
        $test_item = $item->prepare();
        $this->assertEquals(1, $test_item['weight']['value']);
        $this->assertEquals(WeightUnits::_POUND, $test_item['weight']['units']);
        $this->assertEquals(12, $test_item['dimensions']['height']);
        $this->assertEquals(12, $test_item['dimensions']['width']);
        $this->assertEquals(12, $test_item['dimensions']['length']);
        $this->assertEquals(LinearUnits::_INCH, $test_item['dimensions']['units']);
        $this->assertEquals(2, $test_item['groupPackageCount']);
        $this->assertEquals(1, $test_item['sequenceNumber']);
        $this->assertEquals(SubPackagingType::_BAG, $test_item['subPackagingType']);
        $this->assertEquals(100, $test_item['declaredValue']['amount']);
        $this->assertEquals('USD', $test_item['declaredValue']['currency']);
        $this->assertEquals(DangerousGoodsAccessibilityType::_ACCESSIBLE, $test_item['packageSpecialServices']['dangerousGoodsDetail']['accessibility']);
    }
}
