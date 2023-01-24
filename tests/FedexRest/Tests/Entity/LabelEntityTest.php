<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Services\Ship\Entity\Label;
use FedexRest\Services\Ship\Type\ImageType;
use FedexRest\Services\Ship\Type\LabelStockType;
use PHPUnit\Framework\TestCase;

class LabelEntityTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $label = (new Label())
            ->setLabelStockType(LabelStockType::_STOCK_4X6)
            ->setImageType(ImageType::_PDF);
        $this->assertObjectHasAttribute('imageType', $label);
        $this->assertObjectHasAttribute('labelStockType', $label);
        $this->assertEquals(LabelStockType::_STOCK_4X6, $label->prepare()['labelStockType']);
        $this->assertEquals(ImageType::_PDF, $label->prepare()['imageType']);
    }
}
