<?php

namespace FedexRest\Services\TradeDocument;

use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\TradeDocument\Entity\Document;
use GuzzleHttp\Exception\GuzzleException;

class UploadDocument extends AbstractRequest
{

    protected string $production_url = 'https://documentapi.prod.fedex.com';
    protected string $testing_url = 'https://documentapitest.prod.fedex.com/sandbox';
    public string $attachment;
    public Document $document;

    public function setAttachment(string $attachment): UploadDocument
    {
        $this->attachment = $attachment;
        return $this;
    }

    public function setDocument(Document $document): UploadDocument
    {
        $this->document = $document;
        return $this;
    }

    public function prepare(): array {
        return [
            [
                'name' => 'attachment',
                'contents' => $this->attachment,
                'filename' => $this->document->name,
                'headers' => [
                    'Content-Type' => $this->document->contentType
                ]
            ],
            [
                'name' => 'document',
                'contents' =>  json_encode($this->document->prepare())
            ]
        ];
    }

    public function setApiEndpoint()
    {
        return '/documents/v1/etds/upload';
    }

    /**
     * @throws MissingAccessTokenException
     * @throws GuzzleException
     */
    public function request() {
        parent::request();
        try {
            $query = $this->http_client->post($this->getApiUri($this->api_endpoint), [
                'multipart' => $this->prepare(),
                'http_errors' => FALSE,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
