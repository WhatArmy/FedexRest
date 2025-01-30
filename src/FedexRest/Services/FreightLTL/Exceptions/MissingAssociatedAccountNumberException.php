<?php

namespace FedexRest\Services\FreightLTL\Exceptions;

class MissingAssociatedAccountNumberException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
