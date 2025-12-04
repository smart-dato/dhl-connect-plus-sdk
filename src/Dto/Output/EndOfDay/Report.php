<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\EndOfDay;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class Report extends Data
{
    public function __construct(
        #[MapInputName('Shipments')]
        public readonly array $shipments,
        #[MapInputName('Report')]
        public readonly string $report,
    ) {}
}
