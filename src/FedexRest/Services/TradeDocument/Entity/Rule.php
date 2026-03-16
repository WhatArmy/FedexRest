<?php

namespace FedexRest\Services\TradeDocument\Entity;

class Rule
{
    public string $workflowName;

    public function setWorkflowName(string $workflowName): Rule
    {
        $this->workflowName = $workflowName;
        return $this;
    }

    public function prepare(): array
    {
        return [
            'workflowName' => $this->workflowName,
        ];
    }
}