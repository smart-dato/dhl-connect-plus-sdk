<?php

namespace SmartDato\DhlConnectPlusClient\Tests\Requests\Pickup;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Dto\Input\Pickup\CreatePickupPayload;
use SmartDato\DhlConnectPlusClient\Dto\Input\Pickup\Pickup;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Receiver;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use SmartDato\DhlConnectPlusClient\Enums\Label\Format;
use SmartDato\DhlConnectPlusClient\Requests\Authentication\Authenticate;
use SmartDato\DhlConnectPlusClient\Requests\Pickup\Create;

test('create pickup success', function (): void {
    $token = 'token2025';
    $mockClient = new MockClient([
        Authenticate::class => MockResponse::make(body: $token, status: 200),
        Create::class => MockResponse::make(body: [
            'Origin' => '08',
            'Customer' => '001000',
            'Tracking' => '0870002260',
            'AWB' => '',
            'LP' => [
                'JJD00006080070002260001',
            ],
            'Label' => base64_encode('label file'),
            'Pickup' => [
                'pickupId' => '12345',
                'customer' => '001000',
                'pickupDate' => '2023-10-01',
                'quantity' => '2',
                'weight' => '5',
                'contactName' => 'John Doe',
                'timeFrom' => '09:00',
                'timeTo' => '17:00',
                'remarks' => 'Special instructions',
                'product' => 'Express',
                'sender' => [
                    'name' => 'DHL Parcel Barcelona',
                    'address' => 'Les Minetes,2-3',
                    'city' => 'Santa Perpetua',
                    'postalcode' => '08130',
                    'country' => 'ES',
                    'phone' => '+34935656885',
                    'email' => 'ferran.julian@dhl.com',
                ],
            ],
        ], status: 200),
    ]);

    $connector = new DhlConnectPlusConnector;
    $connector->withMockClient($mockClient);
    $payload = new CreatePickupPayload(
        customerId: '#randomId',
        quantity: 2,
        weight: 5,
        sender: new Sender(
            name: 'DHL Parcel Barcelona',
            address: 'Les Minetes,2-3',
            city: 'Santa Perpetua',
            postalcode: '08130',
            country: 'ES',
            phone: '+34935656885',
            email: 'ferran.julian@dhl.com'
        ),
        receiver: new Receiver(
            name: 'DHL Parcel Madrid',
            address: 'Río Almanzora,s/n',
            city: 'Getafe',
            postalcode: '28906',
            country: 'ES',
            phone: '+34935656885',
            email: 'ferran.julian@dhl.com'
        ),
        reference: 'ALB123456',
        pickup: new Pickup(
            contactName: 'DHL Parcel Barcelona',
            remarks: 'Handle with care',
            pickupDate: '2023-10-01',
            timeTo: '17:00',
            timeFrom: '09:00',
        ),
        goodsDescription: 'Test goods',
        format: Format::Pdf
    );
    $response = $connector->send(new Create($payload));

    $label = $response->dto();

    expect($label->origin)->toEqual('08');
    expect($label->tracking)->toEqual('0870002260');
    expect($label->pickup->pickupId)->toEqual('12345');
});
