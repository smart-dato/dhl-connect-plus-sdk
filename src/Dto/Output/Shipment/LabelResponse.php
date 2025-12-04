<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Shipment;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @property-read string $label Base64 encode label file
 * @property-read string[] $lp
 */
class LabelResponse extends Data
{
    public function __construct(
        #[MapInputName('Origin')]
        public readonly string $origin,
        #[MapInputName('Customer')]
        public readonly string $customer,
        #[MapInputName('Tracking')]
        public readonly string $tracking,
        #[MapInputName('AWB')]
        public readonly string $awb,
        #[MapInputName('Label')]
        public readonly string $label,
        #[MapInputName('LP')]
        public readonly array $lp,
    ) {}
}
