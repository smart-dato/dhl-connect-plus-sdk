<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Tracking;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SmartDato\DhlConnectPlusClient\Dto\Output\Tracking\TrackAllEvent;
use SmartDato\DhlConnectPlusClient\Enums\Idioma;
use SmartDato\DhlConnectPlusClient\Enums\Level;
use SmartDato\DhlConnectPlusClient\Enums\Show;

/**
 * @property string $id id: shipment id, LP, AWB, Ref.
 * @property string|null $refcli Refcli : optional, customer code for reference searching
 * @property string|null $awb AWB : optional, customer code for AWB searching
 * @property Idioma $idioma idioma : optional, by default es (es, pt, en)
 * @property Show|null $show show : opcional, EVENTS , STATUS or BOTH
 * @property Level|null $level level : opcional. PARCEL (events, status in parcel level)
 */
class TrackAllEvents extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $customerId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/track';
    }

    protected function defaultQuery(): array
    {
        return [
            'id' => $this->customerId,
            'show' => 'AllEvents',
        ];
    }

    /**
     * @return TrackAllEvent[]
     */
    public function createDtoFromResponse(Response $response): array
    {
        /**
         * @var array<int, array>
         */
        $data = $response->json();

        return array_map(fn ($item): TrackAllEvent => TrackAllEvent::from($item), $data);
    }
}
