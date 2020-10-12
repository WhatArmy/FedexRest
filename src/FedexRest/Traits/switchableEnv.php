<?php


namespace FedexRest\Traits;


trait switchableEnv
{
    public bool $productionMode = false;
    protected string $production_url = 'https://apis.fedex.com';
    protected string $testing_url = 'https://apis-sandbox.fedex.com';

    /**
     * @return string
     */
    public function getUri()
    {
        return ($this->productionMode === false) ? $this->testing_url : $this->production_url;
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
