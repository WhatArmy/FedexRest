<?php

namespace FedexRest\Services\TradeDocument;

use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\TradeDocument\Entity\Document;
use GuzzleHttp\Exception\GuzzleException;

class UploadDocument extends AbstractRequest
{

    protected string $content_type = 'multipart/form-data';
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
            'attachment' => $this->attachment,
            'document' => $this->document->prepare(),
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
