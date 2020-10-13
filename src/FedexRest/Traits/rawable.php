<?php


namespace FedexRest\Traits;


trait rawable
{
    public $raw = false;

    public function rawResponse()
    {
        $this->raw = true;
    }
}
