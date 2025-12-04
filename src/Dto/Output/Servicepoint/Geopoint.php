<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Servicepoint;

use Spatie\LaravelData\Data;

class Geopoint extends Data
{
    public function __construct(
        public readonly string $latitude,
        public readonly string $longitude,
    ) {}
}
