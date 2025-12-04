<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Tracking;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @property-read string $dateTime Date Time of event. "2020-01-30T09:27:53"
 * @property-read string $code T – Transit A – Out for delivery R – delivered ….
 * @property-read string $status Shipment status text. Departed from Arrived at Out for delivery Delivered …..
 * @property-read string $ubication Shipment ubication.
 * @property-read string|null $licensePlate LP Number. when level = “parcel” JJD00006504068783720001
 */
class TrackEvent extends Data
{
    public function __construct(
        #[MapInputName('DateTime')]
        public readonly string $dateTime,
        #[MapInputName('Code')]
        public readonly string $code,
        #[MapInputName('Status')]
        public readonly string $status,
        #[MapInputName('Ubication')]
        public readonly string $ubication,
        #[MapInputName('LicensePlate')]
        public readonly ?string $licensePlate = null,
    ) {}
}
