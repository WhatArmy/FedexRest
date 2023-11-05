<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Services\Ship\Entity\ShippingChargesPayment;
use PHPUnit\Framework\TestCase;

class ShippingChargesPaymentTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $ShippingChargesPayment = (new ShippingChargesPayment())
            ->setPaymentType('SENDER');
        $this->assertObjectHasProperty('paymentType', $ShippingChargesPayment);
        $this->assertEquals('SENDER', $ShippingChargesPayment->prepare()['paymentType']);
    }
}
