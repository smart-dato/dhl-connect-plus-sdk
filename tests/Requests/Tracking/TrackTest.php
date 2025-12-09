<?php

namespace SmartDato\DhlConnectPlusClient\Tests\Requests\Tracking;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Enums\Idioma;
use SmartDato\DhlConnectPlusClient\Enums\Show;
use SmartDato\DhlConnectPlusClient\Requests\Authentication\Authenticate;
use SmartDato\DhlConnectPlusClient\Requests\Tracking\Track;

test('track success', function (): void {
    $token = 'token2025';
    $mockClient = new MockClient([
        Authenticate::class => MockResponse::make(body: json_encode($token), status: 200),
        Track::class => MockResponse::make(body: [
            [
                'DateTime' => '2020-10-01T16:24:43',
                'Code' => 'T',
                'Status' => 'Departed from',
                'Ubication' => 'Gipuzkoa',
            ],
        ], status: 200),
    ]);

    $connector = new DhlConnectPlusConnector;
    $connector->withMockClient($mockClient);

    $response = $connector->send(new Track(
        id: 2013902080,
        idioma: Idioma::Es,
        show: Show::Events,
    ));

    $event = $response->dto()[0];

    expect($event->code)->toEqual('T');
    expect($event->dateTime)->toEqual('2020-10-01T16:24:43');
});
