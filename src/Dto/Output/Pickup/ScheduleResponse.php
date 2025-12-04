<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Pickup;

use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use Spatie\LaravelData\Data;

class ScheduleResponse extends Data
{
    public function __construct(
        public readonly string $pickupId,
        public readonly string $customer,
        public readonly string $pickupDate,
        public readonly string $quantity,
        public readonly string $weight,
        public readonly string $contactName,
        public readonly string $timeFrom,
        public readonly string $timeTo,
        public readonly string $remarks,
        public readonly string $product,
        public readonly Sender $sender,
    ) {}
}
