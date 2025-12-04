<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Pickup;

use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Receiver;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use SmartDato\DhlConnectPlusClient\Enums\Feature;
use SmartDato\DhlConnectPlusClient\Enums\Label\Format;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

/**
 * @property Feature[] $features
 */
class CreatePickupPayload extends Data
{
    public function __construct(
        #[MapOutputName('Quantity')]
        public int $quantity,
        #[MapOutputName('Weight')]
        public int $weight,
        #[MapOutputName('Sender')]
        public Sender $sender,
        #[MapOutputName('Receiver')]
        public ?Receiver $receiver = null,
        #[MapOutputName('Reference')]
        public ?string $reference = null,
        #[MapOutputName('WeightVolume')]
        public ?int $weightVolume = null,
        #[MapOutputName('InsuranceAmount')]
        public ?float $insuranceAmount = null,
        #[MapOutputName('InsuranceExpenses')]
        public ?string $insuranceExpenses = null,
        #[MapOutputName('InsuranceCurrency')]
        public ?string $insuranceCurrency = null,
        #[MapOutputName('ServiceType')]
        public ?string $serviceType = null,
        #[MapOutputName('ContactName')]
        public ?string $contactName = null,
        #[MapOutputName('GoodsDescription')]
        public ?string $goodsDescription = null,
        #[MapOutputName('CustomsValue')]
        public ?float $customsValue = null,
        #[MapOutputName('CustomsCurrency')]
        public ?string $customsCurrency = null,
        #[MapOutputName('Format')]
        public ?Format $format = null,
        #[MapOutputName('Product')]
        public ?string $product = null,
        #[MapOutputName('Pickup')]
        public ?Pickup $pickup = null,
    ) {}
}
