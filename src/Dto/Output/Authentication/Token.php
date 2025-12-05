<?php

namespace SmartDato\DhlConnectPlusClient\Dto\Output\Authentication;

use SensitiveParameter;
use Spatie\LaravelData\Data;

class Token extends Data
{
    public function __construct(
        #[SensitiveParameter]
        private readonly string $token,
    ) {}

    public function getToken(): string
    {
        return $this->token;
    }
}
