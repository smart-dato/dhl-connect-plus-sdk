<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Authentication;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use SensitiveParameter;
use SmartDato\DhlConnectPlusClient\Dto\Output\Authentication\Token;

class Authenticate extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private string $username,
        #[SensitiveParameter]
        private string $password,
    ) {}

    public function defaultBody(): array
    {
        return [
            'Username' => $this->username,
            'Password' => $this->password,
        ];
    }

    public function resolveEndpoint(): string
    {
        return '/authenticate';
    }

    public function createDtoFromResponse(Response $response): Token
    {
        $data = $response->body();

        return new Token($data);
    }
}
