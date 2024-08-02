<?php

namespace FedexRest\Services\TradeDocument;

use FedexRest\Exceptions\MissingAccessTokenException;
use FedexRest\Services\AbstractRequest;
use FedexRest\Services\TradeDocument\Entity\ImageDocument;
use FedexRest\Services\TradeDocument\Entity\Rule;
use GuzzleHttp\Exception\GuzzleException;

class UploadImages extends AbstractRequest
{

    protected string $production_url = 'https://documentapi.prod.fedex.com';
    protected string $testing_url = 'https://documentapitest.prod.fedex.com/sandbox';
    public string $attachment;
    public ImageDocument $document;

    public Rule $rules;

    public function setAttachment(string $attachment): UploadImages
    {
        $this->attachment = $attachment;
        return $this;
    }

    public function setDocument(ImageDocument $document): UploadImages
    {
        $this->document = $document;
        return $this;
    }

    public function setRules(Rule $rules): UploadImages
    {
        $this->rules = $rules;
        return $this;
    }

    public function prepare(): array {
        $document = [
            'document' => $this->document->prepare(),
            'rules' => $this->rules->prepare(),
        ];
        // The order of the parameters in the request is fixed. You have to put the "document" param before the "attachment" param.
        return [
            [
                'name' => 'document',
                'contents' => json_encode($document)
            ],
            [
                'name' => 'attachment',
                'contents' => $this->attachment,
                'filename' => $this->document->name,
                'headers' => [
                    'Content-Type' => $this->document->contentType
                ]
            ]
        ];
    }

    public function setApiEndpoint()
    {
        return '/documents/v1/lhsimages/upload';
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
