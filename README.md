# DHL Connect Plus

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/developer/dhl-connect-plus/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/developer/dhl-connect-plus/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/developer/dhl-connect-plus/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/developer/dhl-connect-plus/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)

A PHP SDK for integrating with DHL Parcel Iberia's CIMAPI (Customer Integration Management API). This package provides an easy-to-use interface for creating shipments, tracking packages, managing pickups, finding service points, and handling end-of-day operations for B2B and B2C deliveries across Spain and Portugal.

The SDK is built on top of [Saloon](https://github.com/saloonphp/saloon) for robust HTTP client functionality and supports JWT-based authentication as required by DHL's API.

## Requirements

- PHP 8.4 or higher
- Laravel 11.0 or 12.0
- Saloon 3.0

## Installation

You can install the package via composer:

```bash
composer require smart-dato/dhl-connect-plus-sdk
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="dhl-connect-plus-sdk-config"
```

This is the contents of the published config file:

```php
return [
    'url' => env('DHL_CONNECT_PLUS_SDK_BASE_URL', 'https://external.dhl.es/cimapi/api/v1/customer'),
    'auth' => [
        'username' => env('DHL_CONNECT_PLUS_SDK_USERNAME', 'Username2025'),
        'password' => env('DHL_CONNECT_PLUS_SDK_PASSWORD', 'Password312'),
        'customer_id' => env('DHL_CONNECT_PLUS_SDK_CUSTOMER_ID', '00-111000'),
    ],
];
```


## Usage

### Authentication

First, authenticate to get an access token:

```php
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Requests\Authentication\Authenticate;

$connector = new DhlConnectPlusConnector;
$token = $connector->send(new Authenticate('test', 'user'));
// Token is automatically stored and used for subsequent requests
```

### Creating a Shipment

Create a basic B2B shipment:

```php
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\CreateShipmentPayload;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Receiver;
use SmartDato\DhlConnectPlusClient\Dto\Input\Shipment\Sender;
use SmartDato\DhlConnectPlusClient\Requests\Shipment\Create;

$payload = new CreateShipmentPayload(
    quantity: 2,
    weight: 5,
    incoterms: 'CPT',
    receiver: new Receiver(
        name: 'DHL Parcel Madrid',
        address: 'Río Almanzora,s/n',
        city: 'Getafe',
        postalcode: '28906',
        country: 'ES',
        phone: '+34935656885',
        email: 'ferran.julian@dhl.com'
    ),
    sender: new Sender(
        name: 'DHL Parcel Barcelona',
        address: 'Les Minetes,2-3',
        city: 'Santa Perpetua',
        postalcode: '08130',
        country: 'ES',
        phone: '+34935656885',
        email: 'ferran.julian@dhl.com'
    ),
    reference: 'ALB123456',
    weightVolume: 0,
    codAmount: 0,
    codExpenses: 'P',
    codCurrency: 'EUR',
    insuranceAmount: 0,
    insuranceExpenses: 'P',
    insuranceCurrency: 'EUR',
    deliveryNote: 'S',
    remarks1: '',
    remarks2: '',
    contactName: '',
    goodsDescription: '',
    customsValue: 0,
    customsCurrency: '',
    format: 'PDF'
);

$connector = new DhlConnectPlusConnector;
$label = $connector->send(new Create($payload));

// Access tracking number and label
$trackingNumber = $label->tracking;
$labelBase64 = $label->label;
```

### Tracking a Shipment

Track a shipment by tracking number:

```php
use SmartDato\DhlConnectPlusClient\DhlConnectPlusConnector;
use SmartDato\DhlConnectPlusClient\Requests\Tracking\Track;
use SmartDato\DhlConnectPlusClient\Enums\Idioma;
use SmartDato\DhlConnectPlusClient\Enums\Show;


$connector = new DhlConnectPlusConnector;
$trackEvent = $connector->send(new Track(
    id: '0870002260',
    idioma: Idioma::En,
    show: Show::Events,
));
// Returns array of tracking events
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SmartDato](https://github.com/smart-dato)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
