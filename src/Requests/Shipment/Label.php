<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Shipment;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SmartDato\DhlConnectPlusClient\Dto\Output\Shipment\LabelResponse;
use SmartDato\DhlConnectPlusClient\Enums\Label\Action;
use SmartDato\DhlConnectPlusClient\Enums\Label\Format;

class Label extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $tracking,
        private readonly string $year,
        private readonly ?Action $action = Action::Print,
        private readonly ?string $labelFrom = null,
        private readonly ?string $labelTo = null,
        private readonly ?Format $format = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/shipment';
    }

    protected function defaultQuery(): array
    {
        $params = [
            'Tracking' => $this->tracking,
            'Year' => $this->year,
            'Action' => $this->action,
        ];

        if ($this->labelFrom !== null) {
            $params['LabelFrom'] = $this->labelFrom;
        }

        if ($this->labelTo !== null) {
            $params['LabelTo'] = $this->labelTo;
        }

        if ($this->format !== null) {
            $params['Format'] = $this->format;
        }

        return $params;
    }

    /**
     * Only has something in response when action is Print
     */
    public function createDtoFromResponse(Response $response): ?LabelResponse
    {
        if ($this->action !== Action::Print) {
            return null;
        }

        $data = $response->json();

        return LabelResponse::from($data);
    }
}
