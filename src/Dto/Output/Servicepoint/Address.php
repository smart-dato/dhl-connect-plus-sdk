<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Servicepoint;

use Spatie\LaravelData\Data;

class Address extends Data
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $zipCode,
        public readonly string $city,
        public readonly string $street,
        public readonly string $number,
        public readonly bool $isBusiness,
        public readonly string $postalCode,
    ) {}
}
