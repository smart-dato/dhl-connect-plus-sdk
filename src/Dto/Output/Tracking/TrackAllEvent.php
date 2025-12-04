<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Tracking;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @property-read string $account Customer account
 * @property-read string $product Producto code
 * @property-read string $origin Shipment origin.
 * @property-read string $shipReference Customer reference
 * @property-read string $tracking LP number
 * @property-read string $dateTime Event Date/time. "2020-01-30T09:27:53"
 * @property-read string $code Event code
 * @property-read string $status Text status event in 3 languages ES, PT, EN Salida de Llegada a En reparto Entregado …...
 * @property-read string $ubication Event generation site.
 */
class TrackAllEvent extends Data
{
    public function __construct(
        #[MapInputName('Account')]
        public readonly string $account,
        #[MapInputName('Product')]
        public readonly string $product,
        #[MapInputName('Origin')]
        public readonly string $origin,
        #[MapInputName('Ship_Reference')]
        public readonly string $shipReference,
        #[MapInputName('Tracking')]
        public readonly string $tracking,
        #[MapInputName('Code')]
        public readonly string $code,
        #[MapInputName('DateTime')]
        public readonly string $dateTime,
        #[MapInputName('Identicket')]
        public readonly string $identicket,
        #[MapInputName('Status')]
        public readonly string $status,
        #[MapInputName('Ubication')]
        public readonly string $ubication,
    ) {}
}
