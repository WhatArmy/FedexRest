<?php

namespace FedexRest\Tests\TradeDocument;

use FedexRest\Authorization\Authorize;
use FedexRest\Services\TradeDocument\Entity\Document;
use FedexRest\Services\TradeDocument\Entity\Meta;
use FedexRest\Services\TradeDocument\UploadDocument;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UploadDocumentTest extends TestCase
{
    protected Authorize $auth;

    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = (new Authorize)
            ->setClientId('l7749d031872cf4b55a7889376f360d045')
            ->setClientSecret('bd59d91084e8482895d4ae2fb4fb79a3');
    }

    public function testHasAccountNumber()
    {
        $meta = (new Meta())
            ->setShipDocumentType('COMMERCIAL_INVOICE')
            ->setFormCode('USMCA')
            ->setTrackingNumber('794791292805')
            ->setShipmentDate('2021-02-17T00:00:00')
            ->setOriginLocationCode('GVTKK')
            ->setOriginCountryCode('US')
            ->setDestinationLocationCode('DEL')
            ->setDestinationCountryCode('IN');
        $document = (new Document())
            ->setWorkflowName('ETDPreshipment')
            ->setCarrierCode('FDXE')
            ->setName('file.txt')
            ->setContentType('text/plain')
            ->setMeta($meta);
        $request = (new UploadDocument())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setDocument($document)
            ->setAttachment('file.txt')
            ->request();
        Assert::assertInstanceOf(\stdClass::class, $request);
        Assert::assertNotEmpty($request->output->meta->docId);
    }
}