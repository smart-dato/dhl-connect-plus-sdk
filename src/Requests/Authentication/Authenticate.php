<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Authentication;

use JsonException;
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

    /**
     * @throws JsonException
     */
    public function createDtoFromResponse(Response $response): Token
    {
        $data = json_decode($response->body(), flags: \JSON_THROW_ON_ERROR);

        return new Token($data);
    }
}
