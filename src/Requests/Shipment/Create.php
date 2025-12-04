<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Shipment;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\CreateShipmentPayload;
use SmartDato\DhlConnectPlusClient\Dto\Output\Shipment\LabelResponse;

class Create extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreateShipmentPayload $payload
    ) {}

    public function resolveEndpoint(): string
    {
        return '/shipment';
    }

    public function defaultBody(): array
    {
        return [
            'Customer' => config('dhl-connect-plus-sdk.auth.customer_id'),
            ...$this->payload->toArray(),
        ];
    }

    public function createDtoFromResponse(Response $response): LabelResponse
    {
        $data = $response->json();

        return LabelResponse::from($data);
    }
}
