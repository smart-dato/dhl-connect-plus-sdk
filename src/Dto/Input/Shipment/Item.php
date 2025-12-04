<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Shipment;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class Item extends Data
{
    public function __construct(
        #[MapOutputName('LineNumber')]
        public ?int $lineNumber,
        #[MapOutputName('Quantity')]
        public ?int $quantity,
        #[MapOutputName('Description')]
        public ?string $description,
        #[MapOutputName('TotalAmount')]
        public ?float $totalAmount,
        #[MapOutputName('TotalWeight')]
        public ?float $totalWeight,
        #[MapOutputName('CountryOrigin')]
        public ?string $countryOrigin,
        #[MapOutputName('TarifCode')]
        public ?string $tarifCode,
    ) {}
}
