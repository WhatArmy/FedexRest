<?php

namespace FedexRest\Services\FreightLTL\Entity;

class RateRequestControlParameters
{

    protected ?bool $returnTransitTimes = false;
    protected ?bool $serviceNeededOnRateFailure = null;
    protected ?string $variableOptions = null;
    protected ?string $rateSortOrder = 'SERVICENAMETRADITIONAL';

    /**
     * Set the value of returnTransitTimes
     * @param bool|null $returnTransitTimes
     * @return  $this
     */
    public function setReturnTransitTimes(?bool $returnTransitTimes): self
    {
        $this->returnTransitTimes = $returnTransitTimes;

        return $this;
    }

    /**
     * Set the value of serviceNeededOnRateFailure
     * @param bool|null $serviceNeededOnRateFailure
     * @return  $this
     */
    public function setServiceNeededOnRateFailure(?bool $serviceNeededOnRateFailure): self
    {
        $this->serviceNeededOnRateFailure = $serviceNeededOnRateFailure;

        return $this;
    }

    /**
     * Set the value of variableOptions
     * @param string|null $variableOptions
     * @return  $this
     */
    public function setVariableOptions(?string $variableOptions): self
    {
        $this->variableOptions = $variableOptions;

        return $this;
    }

    /**
     * Set the value of rateSortOrder
     * @param string|null $rateSortOrder
     * @return  $this
     */
    public function setRateSortOrder(?string $rateSortOrder): self
    {
        $this->rateSortOrder = $rateSortOrder;

        return $this;
    }


    public function prepare(): array
    {
        $data = [];
        if (!empty($this->returnTransitTimes)) {
            $data['returnTransitTimes'] = $this->returnTransitTimes;
        }
        if (!empty($this->serviceNeededOnRateFailure)) {
            $data['serviceNeededOnRateFailure'] = $this->serviceNeededOnRateFailure;
        }
        if (!empty($this->variableOptions)) {
            $data['variableOptions'] = $this->variableOptions;
        }
        if (!empty($this->rateSortOrder)) {
            $data['rateSortOrder'] = $this->rateSortOrder;
        }
        return $data;
    }
}
