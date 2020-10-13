<?php


namespace FedexRest\Traits;


trait switchableEnv
{
    public bool $productionMode = false;
    protected string $production_url = 'https://apis.fedex.com';
    protected string $testing_url = 'https://apis-sandbox.fedex.com';

    /**
     * @param $endpoint
     * @return string
     */
    public function getApiUri($endpoint = '')
    {
        return (($this->productionMode === false) ? $this->testing_url : $this->production_url).$endpoint;
    }

    /**
     * @return $this
     */
    public function useProduction()
    {
        $this->productionMode = true;
        return $this;
    }
}
