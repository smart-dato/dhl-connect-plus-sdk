<?php

namespace SmartDato\DhlConnectPlusClient\Requests\EndOfDay;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\DhlConnectPlusClient\Dto\Output\EndOfDay\Report;
use SmartDato\DhlConnectPlusClient\Enums\EndOfDay\Format;

class Close extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly string $accounts = 'ALL',
        private readonly Format $report = Format::Pdf,
        private readonly bool $onlyDayReport = false,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/endday';
    }

    public function defaultBody(): array
    {
        return [
            'Accounts' => $this->accounts,
            'Report' => $this->report->value,
            'OnlyDayReport' => (int) $this->onlyDayReport,
        ];
    }

    public function createDtoFromResponse(Response $response): Report
    {
        $data = $response->json();

        return Report::from($data);
    }
}
