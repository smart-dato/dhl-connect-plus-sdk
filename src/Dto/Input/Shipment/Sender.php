<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Shipment;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class Sender extends Data
{
    public function __construct(
        #[MapOutputName('Name')]
        public string $name,
        #[MapOutputName('Address')]
        public string $address,
        #[MapOutputName('City')]
        public string $city,
        #[MapOutputName('Postalcode')]
        public string $postalcode,
        #[MapOutputName('Country')]
        public string $country,
        #[MapOutputName('Phone')]
        public ?string $phone = null,
        #[MapOutputName('Email')]
        public ?string $email = null,
        #[MapOutputName('SendLabel')]
        public ?bool $sendLabel = null,
    ) {}
}
