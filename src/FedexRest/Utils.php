<?php


namespace FedexRest;


class Utils
{
    public function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }
}
