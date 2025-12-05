<?php

namespace SmartDato\DhlConnectPlusClient;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\PendingRequest;
use SensitiveParameter;
use SmartDato\DhlConnectPlusClient\Dto\Output\Authentication\Token;
use SmartDato\DhlConnectPlusClient\Requests\Authentication\Authenticate;

class DhlConnectPlusConnector extends Connector
{
    private ?Token $authToken = null;

    public function setToken(Token $token): static
    {
        $this->authToken = $token;

        return $this;
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function boot(PendingRequest $pendingRequest): void
    {
        if ($pendingRequest->getRequest() instanceof Authenticate) {
            return;
        }

        if ($this->authToken !== null) {
            $pendingRequest->authenticate(
                new TokenAuthenticator($this->authToken->getToken())
            );

            return;
        }

        $request = new Authenticate(
            username: config('dhl-connect-plus-sdk.auth.username'),
            password: config('dhl-connect-plus-sdk.auth.password')
        );
        $authResponse = $this->send($request);

        $this->authToken = $authResponse->dtoOrFail();

        $pendingRequest->authenticate(
            new TokenAuthenticator($this->authToken->getToken())
        );
    }

    public function resolveBaseUrl(): string
    {
        return config('dhl-connect-plus-sdk.base_url');
    }
}
