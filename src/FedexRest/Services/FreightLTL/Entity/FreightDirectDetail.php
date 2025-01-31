<?php

namespace FedexRest\Services\FreightLTL\Entity;

class FreightDirectDetail
{
    protected ?array $freightDirectDataDetails = null;

    /**
     * @param FreightDirectDataDetails[] $freightDirectDataDetails
     * @return FreightDirectDetail
     */
    public function setFreightDirectDataDetails(FreightDirectDataDetails ...$freightDirectDataDetails): FreightDirectDetail
    {
        $this->freightDirectDataDetails = $freightDirectDataDetails;
        return $this;
    }

    public function prepare()
    {
        $data = [
            'freightDirectDataDetails' => [],
        ];
        foreach ($this->freightDirectDataDetails as $freightDirectDataDetail) {
            $data['freightDirectDataDetails'][] = $freightDirectDataDetail->prepare();
        }
        return $data;
    }

}
