<?php

namespace FedexRest\Tests\TradeDocument;

use FedexRest\Authorization\Authorize;
use FedexRest\Services\TradeDocument\Entity\Document;
use FedexRest\Services\TradeDocument\Entity\ImageDocument;
use FedexRest\Services\TradeDocument\Entity\ImageMeta;
use FedexRest\Services\TradeDocument\Entity\Meta;
use FedexRest\Services\TradeDocument\Entity\Rule;
use FedexRest\Services\TradeDocument\UploadDocument;
use FedexRest\Services\TradeDocument\UploadImages;
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

    public function testUploadDocument()
    {
        $meta = (new Meta())
            ->setShipDocumentType('COMMERCIAL_INVOICE')
            //->setFormCode('USMCA')
            //->setTrackingNumber('794791292805')
            //->setShipmentDate('2021-02-17T00:00:00')
            //->setOriginLocationCode('GVTKK')
            ->setOriginCountryCode('US')
            //->setDestinationLocationCode('DEL')
            ->setDestinationCountryCode('IN');
        $document = (new Document())
            ->setWorkflowName('ETDPreshipment')
            //->setCarrierCode('FDXE')
            ->setName('file.txt')
            ->setContentType('text/plain')
            ->setMeta($meta);
        $path = __DIR__.'/../../resources/document.txt';
        $content = file_get_contents($path);
        $request = (new UploadDocument())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setDocument($document)
            ->setAttachment($content)
            ->request();
        $this->assertObjectHasProperty('customerTransactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $this->assertObjectHasProperty('meta', $request->output);
        $this->assertObjectHasProperty('docId', $request->output->meta);
        $this->assertNotEmpty($request->output->meta->docId);
    }

    public function testUploadImages()
    {
        //$this->markTestIncomplete('Always fails with: "Invalid request: invalid input : WorkFlow Name"');
        $meta = (new ImageMeta())
            ->setImageType('SIGNATURE')
            ->setImageIndex('IMAGE_1');
        $rules = (new Rule())->setWorkflowName('LetterheadSignature');
        $document = (new ImageDocument())
            ->setReferenceId('1234')
            ->setName('LH2.PNG')
            ->setContentType('image/png')
            ->setMeta($meta);
        $path = __DIR__.'/../../resources/signature.png';
        $content = file_get_contents($path);
        $request = (new UploadImages())
            ->setAccessToken((string) $this->auth->authorize()->access_token)
            ->setDocument($document)
            ->setRules($rules)
            ->setAttachment($content)
            ->request();
        $this->assertObjectHasProperty('customerTransactionId', $request);
        $this->assertObjectNotHasProperty('errors', $request);
        $this->assertObjectHasProperty('output', $request);
        $this->assertObjectHasProperty('documentReferenceId', $request->output);
        $this->assertNotEmpty($request->output->documentReferenceId);
    }
}