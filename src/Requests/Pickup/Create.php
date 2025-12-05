<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Pickup;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\DhlConnectPlusClient\Dto\Input\Pickup\CreatePickupPayload;
use SmartDato\DhlConnectPlusClient\Dto\Output\Pickup\LabelResponse;

class Create extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly CreatePickupPayload $payload
    ) {}

    public function resolveEndpoint(): string
    {
        return '/shipment';
    }

    public function defaultBody(): array
    {
        return $this->payload->toArray();
    }

    public function createDtoFromResponse(Response $response): LabelResponse
    {
        /**
         * @var array<int, array>
         */
        $data = $response->json();

        return LabelResponse::from($data);
    }
}
