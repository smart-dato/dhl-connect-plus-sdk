<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Pickup;

use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class SchedulePickupPayload extends Data
{
    public function __construct(
        #[MapOutputName('Customer')]
        public string $customerId,
        #[MapOutputName('ContactName')]
        public string $contactName,
        #[MapOutputName('Quantity')]
        public int $quantity,
        #[MapOutputName('Weight')]
        public int $weight,
        #[MapOutputName('PickupDate')]
        public string $pickupDate,
        #[MapOutputName('TimeFrom')]
        public string $timeFrom,
        #[MapOutputName('TimeTo')]
        public string $timeTo,
        #[MapOutputName('Remarks')]
        public string $remarks,
        #[MapOutputName('Sender')]
        public ?Sender $sender,
        #[MapOutputName('Pickup')]
        public ?string $pickup = null,
    ) {}
}
