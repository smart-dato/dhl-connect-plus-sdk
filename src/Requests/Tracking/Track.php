<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Tracking;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SmartDato\DhlConnectPlusClient\Dto\Output\Tracking\TrackEvent;
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
class Track extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private readonly string $id,
        private readonly ?string $refcli = null,
        private readonly ?string $awb = null,
        private readonly Idioma $idioma = Idioma::Es,
        private readonly ?Show $show = null,
        private readonly ?Level $level = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/track';
    }

    protected function defaultQuery(): array
    {
        $params = [
            'id' => $this->id,
            'idioma' => $this->idioma->value,
        ];

        if ($this->refcli !== null) {
            $params['Refcli'] = $this->refcli;
        }

        if ($this->awb !== null) {
            $params['AWB'] = $this->awb;
        }

        if ($this->show !== null) {
            $params['show'] = $this->show->value;
        }

        if ($this->level !== null) {
            $params['level'] = $this->level->value;
        }

        return $params;
    }

    /**
     * @return TrackEvent[]
     */
    public function createDtoFromResponse(Response $response): array
    {
        /**
         * @var array<int, array>
         */
        $data = $response->json();

        return array_map(fn ($item): TrackEvent => TrackEvent::from($item), $data);
    }
}
