<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Shipment;

use SmartDato\DhlConnectPlusClient\Enums\Feature;
use SmartDato\DhlConnectPlusClient\Enums\Product;
use SmartDato\DhlConnectPlusClient\Enums\ServiceType;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\MaxDigits;
use Spatie\LaravelData\Data;

/**
 * @property string $serviceType Only for Delivery in Canary Islands– Azores- Madeira M – Maritim service A – Air Service
 * @property Product|null $product product = "" is considered as B2B product.
 * @property Feature[] $features
 */
class CreateShipmentPayload extends Data
{
    public function __construct(
        #[MapOutputName('Customer')]
        #[Max(10)]
        public string $customerId,
        #[MapOutputName('Quantity')]
        #[MaxDigits(3)]
        public int $quantity,
        #[MapOutputName('Weight')]
        #[MaxDigits(5)]
        public int $weight,
        #[MapOutputName('Incoterms')]
        #[Max(3)]
        public string $incoterms,
        #[MapOutputName('Receiver')]
        public Receiver $receiver,
        #[MapOutputName('Sender')]
        public ?Sender $sender = null,
        #[MapOutputName('Reference')]
        #[Max(35)]
        public ?string $reference = null,
        #[MapOutputName('WeightVolume')]
        #[MaxDigits(5)]
        public ?int $weightVolume = null,
        #[MapOutputName('CODAmount')]
        #[MaxDigits(11)]
        public ?float $codAmount = null,
        #[MapOutputName('CODExpenses')]
        #[Max(1)]
        public ?string $codExpenses = null,
        #[MapOutputName('CODCurrency')]
        #[Max(3)]
        public ?string $codCurrency = null,
        #[MapOutputName('InsuranceAmount')]
        #[MaxDigits(9)]
        public ?float $insuranceAmount = null,
        #[MapOutputName('InsuranceExpenses')]
        #[Max(1)]
        public ?string $insuranceExpenses = null,
        #[MapOutputName('InsuranceCurrency')]
        #[Max(3)]
        public ?string $insuranceCurrency = null,
        #[MapOutputName('DeliveryNote')]
        #[Max(1)]
        public ?string $deliveryNote = null,
        #[MapOutputName('ServiceType')]
        #[Max(1)]
        public ?ServiceType $serviceType = null,
        #[MapOutputName('Remarks1')]
        #[Max(40)]
        public ?string $remarks1 = null,
        #[MapOutputName('Remarks2')]
        #[Max(40)]
        public ?string $remarks2 = null,
        #[MapOutputName('ContactName')]
        #[Max(25)]
        public ?string $contactName = null,
        #[MapOutputName('GoodsDescription')]
        #[Max(70)]
        public ?string $goodsDescription = null,
        #[MapOutputName('CustomsValue')]
        #[MaxDigits(15)]
        public ?float $customsValue = null,
        #[MapOutputName('CustomsCurrency')]
        #[Max(3)]
        public ?string $customsCurrency = null,
        #[MapOutputName('Format')]
        #[Max(3)]
        public ?string $format = null,
        #[MapOutputName('Product')]
        public ?Product $product = Product::B2B,
        #[MapOutputName('Features')]
        public ?array $features = null,
        #[MapOutputName('Lp')]
        public ?array $lp = null,
        #[MapOutputName('Customs')]
        public ?Customs $customs = null,
    ) {}
}
