<?php

namespace SmartDato\DhlConnectPlusClient\Tests\Dto\Input\Shipment;

use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\CreateShipmentPayload;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Receiver;

function makeCreateShipmentPayload(?string $incoterms): CreateShipmentPayload
{
    return new CreateShipmentPayload(
        customerId: 'ACC1',
        quantity: 1,
        weight: 8,
        incoterms: $incoterms,
        receiver: new Receiver(
            name: 'Acme',
            address: 'Via Roma 1',
            city: 'Bolzano',
            postalcode: '39100',
            country: 'IT',
            phone: '+39000',
            email: 'a@b.c',
        ),
    );
}

test('toArray omits the Incoterms key when incoterms is null', function (): void {
    $data = makeCreateShipmentPayload(null)->toArray();

    expect($data)->not->toHaveKey('Incoterms');
});

test('toArray keeps the Incoterms key when incoterms is set', function (): void {
    $data = makeCreateShipmentPayload('DAP')->toArray();

    expect($data['Incoterms'])->toBe('DAP');
});
