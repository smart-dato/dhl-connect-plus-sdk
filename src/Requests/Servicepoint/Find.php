<?php

namespace SmartDato\DhlConnectPlusClient\Requests\Servicepoint;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use SmartDato\DhlConnectPlusClient\Dto\Output\Servicepoint\Address;
use SmartDato\DhlConnectPlusClient\Dto\Output\Servicepoint\Geopoint;
use SmartDato\DhlConnectPlusClient\Dto\Output\Servicepoint\Place;

class Find extends Request
{
    protected Method $method = Method::GET;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(
        private readonly string $country,
        private readonly ?string $city = null,
        private readonly ?string $postcode = null,
        private readonly ?string $street = null,
        private readonly ?int $radius = null,
        private readonly ?int $limit = 10,
    ) {
        if ($city === null && $postcode === null) {
            throw new \InvalidArgumentException('City or Postcode should be filled.');
        }
    }

    public function resolveEndpoint(): string
    {
        return '/servicepoint';
    }

    protected function defaultQuery(): array
    {
        $params = [
            'Country' => $this->country,
        ];

        if ($this->city !== null) {
            $params['City'] = $this->city;
        }

        if ($this->postcode !== null) {
            $params['Postcode'] = $this->postcode;
        }

        if ($this->street !== null) {
            $params['Street'] = $this->street;
        }

        if ($this->radius !== null) {
            $params['Radius'] = $this->radius;
        }

        if ($this->limit !== null) {
            $params['Limit'] = $this->limit;
        }

        return $params;
    }

    /**
     * @return Place[]
     */
    public function createDtoFromResponse(Response $response): array
    {
        /**
         * @var array<int, array>
         */
        $data = $response->json();

        return array_map(fn ($item): Place => new Place(
            id: $item['id'],
            harmonisedId: $item['harmonisedId'],
            psfKey: $item['psfKey'],
            shopType: $item['shopType'],
            name: $item['name'],
            keyword: $item['keyword'],
            distance: $item['distance'],
            address: Address::from($item['address']),
            geolocation: Geopoint::from($item['geoLocation']),
            openingTimes: $item['openingTimes'],
            closurePeriods: $item['closurePeriods'],
            serviceTypes: $item['serviceTypes']
        ), $data);
    }
}
