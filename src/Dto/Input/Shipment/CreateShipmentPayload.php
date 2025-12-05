<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Shipment;

use SmartDato\DhlConnectPlusClient\Enums\Feature;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

/**
 * @property Feature[] $features
 */
class CreateShipmentPayload extends Data
{
    public function __construct(
        #[MapOutputName('Customer')]
        public string $customerId,
        #[MapOutputName('Quantity')]
        public int $quantity,
        #[MapOutputName('Weight')]
        public int $weight,
        #[MapOutputName('Incoterms')]
        public string $incoterms,
        #[MapOutputName('Receiver')]
        public Receiver $receiver,
        #[MapOutputName('Sender')]
        public ?Sender $sender = null,
        #[MapOutputName('Reference')]
        public ?string $reference = null,
        #[MapOutputName('WeightVolume')]
        public ?int $weightVolume = null,
        #[MapOutputName('CODAmount')]
        public ?float $codAmount = null,
        #[MapOutputName('CODExpenses')]
        public ?string $codExpenses = null,
        #[MapOutputName('CODCurrency')]
        public ?string $codCurrency = null,
        #[MapOutputName('InsuranceAmount')]
        public ?float $insuranceAmount = null,
        #[MapOutputName('InsuranceExpenses')]
        public ?string $insuranceExpenses = null,
        #[MapOutputName('InsuranceCurrency')]
        public ?string $insuranceCurrency = null,
        #[MapOutputName('DeliveryNote')]
        public ?string $deliveryNote = null,
        #[MapOutputName('ServiceType')]
        public ?string $serviceType = null,
        #[MapOutputName('Remarks1')]
        public ?string $remarks1 = null,
        #[MapOutputName('Remarks2')]
        public ?string $remarks2 = null,
        #[MapOutputName('ContactName')]
        public ?string $contactName = null,
        #[MapOutputName('GoodsDescription')]
        public ?string $goodsDescription = null,
        #[MapOutputName('CustomsValue')]
        public ?float $customsValue = null,
        #[MapOutputName('CustomsCurrency')]
        public ?string $customsCurrency = null,
        #[MapOutputName('Format')]
        public ?string $format = null,
        #[MapOutputName('Product')]
        public ?string $product = null,
        #[MapOutputName('Features')]
        public ?array $features = null,
        #[MapOutputName('Lp')]
        public ?array $lp = null,
        #[MapOutputName('Customs')]
        public ?Customs $customs = null,
    ) {}
}
