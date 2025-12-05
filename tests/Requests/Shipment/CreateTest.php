<?php

namespace SmartDato\DhlConnectPlusClient\Tests\Requests\Tracking;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\CreateShipmentPayload;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Receiver;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use SmartDato\DhlConnectPlusClient\Requests\Authentication\Authenticate;
use SmartDato\DhlConnectPlusClient\Requests\Shipment\Create;

test('track success', function (): void {
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
        ], status: 200),
    ]);

    $connector = new DhlConnectPlusConnector;
    $connector->withMockClient($mockClient);
    $payload = new CreateShipmentPayload(
        customerId: '#randomId',
        quantity: 2,
        weight: 5,
        incoterms: 'CPT',
        receiver: new Receiver(
            name: 'DHL Parcel Madrid',
            address: 'Río Almanzora,s/n',
            city: 'Getafe',
            postalcode: '28906',
            country: 'ES',
            phone: '+34935656885',
            email: 'ferran.julian@dhl.com'
        ),
        sender: new Sender(
            name: 'DHL Parcel Barcelona',
            address: 'Les Minetes,2-3',
            city: 'Santa Perpetua',
            postalcode: '08130',
            country: 'ES',
            phone: '+34935656885',
            email: 'ferran.julian@dhl.com'
        ),
        reference: 'ALB123456',
        weightVolume: 0,
        codAmount: 0,
        codExpenses: 'P',
        codCurrency: 'EUR',
        insuranceAmount: 0,
        insuranceExpenses: 'P',
        insuranceCurrency: 'EUR',
        deliveryNote: 'S',
        remarks1: '',
        remarks2: '',
        contactName: '',
        goodsDescription: '',
        customsValue: 0,
        customsCurrency: '',
        format: 'PDF'
    );
    $response = $connector->send(new Create($payload));

    $label = $response->dto();

    expect($label->origin)->toEqual('08');
    expect($label->tracking)->toEqual('0870002260');
});
