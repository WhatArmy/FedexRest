<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Services\Ship\Entity\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $Value = (new Value())
            ->setAmount(12)
            ->setCurrency('USD');
        $this->assertObjectHasProperty('amount', $Value);
        $this->assertObjectHasProperty('currency', $Value);
        $this->assertEquals('USD', $Value->prepare()['currency']);
        $this->assertEquals(12, $Value->prepare()['amount']);
    }
}
