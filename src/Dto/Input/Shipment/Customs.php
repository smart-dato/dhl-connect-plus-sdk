<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Input\Shipment;

use SmartDato\DhlConnectPlusClient\Enums\NatureCode;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class Customs extends Data
{
    public function __construct(
        #[MapOutputName('UK_VAT_Number')]
        public ?string $ukVatNumber = null,
        #[MapOutputName('EOri_Number')]
        public ?string $eOriNumber = null,
        #[MapOutputName('Export_Reason')]
        public ?string $exportReason = null,
        #[MapOutputName('NatureCode')]
        public ?NatureCode $natureCode = null,
        #[MapOutputName('InvoiceNumber')]
        public ?string $invoiceNumber = null,
        #[MapOutputName('Postage_Paid')]
        public ?float $postagePaid = null,
        #[MapOutputName('Customs_Remarks')]
        public ?string $customsRemarks = null,
        #[MapOutputName('Customs_Certificate')]
        public ?string $customsCertificate = null,
        #[MapOutputName('Customs_License')]
        public ?string $customsLicense = null,
        #[MapOutputName('Customs_Invoice_Type')]
        public ?string $customsInvoiceType = null,
        #[MapOutputName('Items')]
        public ?array $items = null,
    ) {}
}
