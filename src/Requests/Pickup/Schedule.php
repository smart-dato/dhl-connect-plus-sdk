<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Shipment;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\DhlConnectPlusClient\Dto\Input\Pickup\SchedulePickupPayload;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use SmartDato\DhlConnectPlusClient\Dto\Output\Pickup\ScheduleResponse;

class Schedule extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly SchedulePickupPayload $payload
    ) {}

    public function resolveEndpoint(): string
    {
        return '/pickup';
    }

    public function defaultBody(): array
    {
        return [
            'Customer' => config('dhl-connect-plus-sdk.auth.customer_id'),
            ...$this->payload->toArray(),
        ];
    }

    public function createDtoFromResponse(Response $response): ScheduleResponse
    {
        $data = $response->json();

        return new ScheduleResponse(
            pickupId: $data['PickupId'],
            customer: $data['Customer'],
            pickupDate: $data['PickupDate'],
            quantity: $data['Quantity'],
            weight: $data['Weight'],
            contactName: $data['ContactName'],
            timeFrom: $data['TimeFrom'],
            timeTo: $data['TimeTo'],
            remarks: $data['Remarks'],
            product: $data['Product'],
            sender: new Sender(
                name: $data['Sender']['Name'],
                address: $data['Sender']['Address'],
                city: $data['Sender']['City'],
                postalcode: $data['Sender']['PostalCode'],
                country: $data['Sender']['Country'],
                phone: $data['Sender']['Phone'],
                email: $data['Sender']['Email'],
            )
        );
    }
}
