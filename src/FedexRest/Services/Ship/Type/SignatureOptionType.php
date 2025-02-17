<?php

namespace FedexRest\Services\Ship\Type;

class SignatureOptionType
{
    const _SERVICE_DEFAULT = 'SERVICE_DEFAULT';
    const _NO_SIGNATURE_REQUIRED = 'USPS_DELIVERY_CONFIRMATION';
    const _INDIRECT = 'INDIRECT';
    const _DIRECT = 'DIRECT';
    const _ADULT = 'ADULT';
}
