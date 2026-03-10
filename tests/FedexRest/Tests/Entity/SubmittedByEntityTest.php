<?php

namespace FedexRest\Tests\Entity;

use PHPUnit\Framework\TestCase;
use FedexRest\Services\FreightLTL\Entity\SubmittedBy;

class SubmittedByEntityTest extends TestCase
{
    public function testItemHasAttributes()
    {
        $submittedBy = (new SubmittedBy())
            ->setCompanyName('Test Company')
            ->setPersonName('Test Person')
            ->setPhoneNumber('1234567890')
            ->setPhoneExtension('123')
            ->setEmailAddress('abc@abc.com');

        $this->assertObjectHasProperty('companyName', $submittedBy);
        $this->assertObjectHasProperty('personName', $submittedBy);
        $this->assertObjectHasProperty('phoneNumber', $submittedBy);
        $this->assertObjectHasProperty('phoneExtension', $submittedBy);
        $this->assertObjectHasProperty('emailAddress', $submittedBy);

        $submittedByPrepared = $submittedBy->prepare();
        $this->assertEquals('Test Company', $submittedByPrepared['companyName']);
        $this->assertEquals('Test Person', $submittedByPrepared['personName']);
        $this->assertEquals('1234567890', $submittedByPrepared['phoneNumber']);
        $this->assertEquals('123', $submittedByPrepared['phoneExtension']);
        $this->assertEquals('abc@abc.com', $submittedByPrepared['emailAddress']);
    }

}
