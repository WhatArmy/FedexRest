<?php

namespace FedexRest\Tests\Entity;

use FedexRest\Services\Ship\Entity\ShipmentSpecialServices;
use FedexRest\Services\Ship\Type\ShipmentSpecialServiceType;
use PHPUnit\Framework\TestCase;

class ShipmentSpecialServicesTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $ShipmentSpecialServices = (new ShipmentSpecialServices())
            ->setSpecialServiceTypes([ShipmentSpecialServiceType::_THIRD_PARTY_CONSIGNEE])
            ->setReturnShipmentDetails(['returnType' => 'PRINT_RETURN_LABEL']);
        $this->assertObjectHasAttribute('returnShipmentDetails', $ShipmentSpecialServices);
        $this->assertObjectHasAttribute('specialServiceTypes', $ShipmentSpecialServices);
    }
}
