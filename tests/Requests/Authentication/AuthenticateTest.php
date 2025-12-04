<?php

namespace SmartDato\DhlConnectPlusClient\Tests\Requests\Authentication;

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Requests\Authentication\Authenticate;

test('auth success', function (): void {
    $token = 'token2025';
    $mockClient = new MockClient([
        Authenticate::class => MockResponse::make(body: $token, status: 200),
    ]);

    $connector = new DhlConnectPlusConnector;
    $connector->withMockClient($mockClient);

    $token = $connector->send(new Authenticate('test', 'user'));

    expect($token->dto()->getToken())->toEqual($token);
});
