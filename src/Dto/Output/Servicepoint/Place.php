<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Servicepoint;

use Spatie\LaravelData\Data;

class Place extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $harmonisedId,
        public readonly string $psfKey,
        public readonly string $shopType,
        public readonly string $name,
        public readonly string $keyword,
        public readonly string $distance,
        public readonly Address $address,
        public readonly Geopoint $geolocation,
        public readonly array $openingTimes,
        public readonly array $closurePeriods,
        public readonly array $serviceTypes,
    ) {}
}
