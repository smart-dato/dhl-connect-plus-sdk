<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Pickup;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class Pickup extends Data
{
    public function __construct(
        #[MapOutputName('ContactName')]
        public readonly string $contactName,
        #[MapOutputName('Remarks')]
        public readonly string $remarks,
        #[MapOutputName('PickupDate')]
        public readonly string $pickupDate,
        #[MapOutputName('TimeFrom')]
        public readonly string $timeFrom,
        #[MapOutputName('TimeTo')]
        public readonly string $timeTo,
    ) {}
}
