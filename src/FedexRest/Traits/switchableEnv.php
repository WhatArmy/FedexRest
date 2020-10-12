<?php


namespace FedexRest\Traits;


trait switchableEnv
{
    protected string $production_url = 'https://apis.fedex.com';
    protected string $testing_url = 'https://apis-sandbox.fedex.com';


    /**
     * @return string
     */
    public function getUri()
    {
        return ($this->productionMode === false) ? $this->testing_url : $this->production_url;
    }
}
