# DHL Connect Plus SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/developer/dhl-connect-plus.svg?style=flat-square)](https://packagist.org/packages/developer/dhl-connect-plus)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/developer/dhl-connect-plus/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/developer/dhl-connect-plus/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/developer/dhl-connect-plus/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/developer/dhl-connect-plus/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/developer/dhl-connect-plus.svg?style=flat-square)](https://packagist.org/packages/developer/dhl-connect-plus)

A PHP SDK for integrating with DHL Parcel Iberia's CIMAPI (Customer Integration Management API). This package provides an easy-to-use interface for creating shipments, tracking packages, managing pickups, finding service points, and handling end-of-day operations for B2B and B2C deliveries across Spain and Portugal.

The SDK is built on top of [Saloon](https://github.com/saloonphp/saloon) for robust HTTP client functionality and supports JWT-based authentication as required by DHL's API.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/dhl-connect-plus-sdk.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/dhl-connect-plus-sdk)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require developer/dhl-connect-plus-sdk
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="dhl-connect-plus-sdk-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="dhl-connect-plus-sdk-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="dhl-connect-plus-sdk-views"
```

## Usage

### Authentication

First, authenticate to get an access token:

```php
use SmartDato\DhlConnectPlus\Facades\DhlConnectPlus;

$token = DhlConnectPlus::authenticate('your-username', 'your-password');
// Token is automatically stored and used for subsequent requests
```

### Creating a Shipment

Create a basic B2B shipment:

```php
use SmartDato\DhlConnectPlus\Facades\DhlConnectPlus;

$shipmentData = [
    'Customer' => '08-001000',
    'Receiver' => [
        'Name' => 'John Doe',
        'Address' => '123 Main St',
        'City' => 'Madrid',
        'PostalCode' => '28001',
        'Country' => 'ES',
        'Phone' => '+34912345678',
        'Email' => 'john@example.com'
    ],
    'Reference' => 'ORDER-12345',
    'Quantity' => 1,
    'Weight' => 2.5,
    'Incoterms' => 'CPT',
    'Format' => 'PDF'
];

$response = DhlConnectPlus::createShipment($shipmentData);

// Access tracking number and label
$trackingNumber = $response['Tracking'];
$labelBase64 = $response['Label'];
```

### Tracking a Shipment

Track a shipment by tracking number:

```php
$trackingInfo = DhlConnectPlus::trackShipment('0870002260', 'en');
// Returns array of tracking events
```

### Service Point Finder

Find nearby service points:

```php
$servicePoints = DhlConnectPlus::findServicePoints([
    'Country' => 'ES',
    'PostalCode' => '28001',
    'Limit' => 5
]);
```

### Requesting a Pickup

Schedule a pickup:

```php
$pickupData = [
    'Customer' => '08-001000',
    'Sender' => [
        'Name' => 'Your Company',
        'Address' => '123 Business St',
        'City' => 'Madrid',
        'PostalCode' => '28001',
        'Country' => 'ES',
        'Phone' => '+34912345678'
    ],
    'ContactName' => 'John Smith',
    'Quantity' => 2,
    'Weight' => 5.0,
    'PickupDate' => '2024-12-01',
    'TimeFrom' => '09:00',
    'TimeTo' => '11:00'
];

$pickupResponse = DhlConnectPlus::requestPickup($pickupData);
```

### End of Day

Close the day and get shipment reports:

```php
$endOfDayReport = DhlConnectPlus::endOfDay([
    'Accounts' => 'ALL',
    'Report' => 'PDF'
]);
```

## Testing

```bash
composer test
```

## Postman Collection

A Postman collection with example API calls is available in the `docs/` directory: [`Ejemplo_WebService B2B DHL Parcel Iberia.postman_collection.json`](docs/Ejemplo_WebService%20B2B%20DHL%20Parcel%20Iberia.postman_collection.json)

## Documentation

For complete API documentation, see: [`Customer_integration_WEB_SERVICE_CIMAPI_ver13.pdf`](docs/Customer_integration_WEB_SERVICE_CIMAPI_ver13.pdf)

## API Reference

### Available Methods

- `authenticate($username, $password)` - Get access token
- `createShipment($data)` - Create new shipment with label
- `printShipment($year, $tracking, $format = 'PDF')` - Print existing shipment label
- `deleteShipment($year, $tracking)` - Delete shipment
- `holdShipment($year, $tracking)` - Hold shipment
- `releaseShipment($year, $tracking)` - Release held shipment
- `trackShipment($id, $language = 'en', $show = 'events')` - Track shipment
- `findServicePoints($params)` - Find service points
- `requestPickup($data)` - Schedule pickup
- `endOfDay($params)` - Generate end of day report

### Shipment Parameters

For detailed parameter information, refer to the [CIMAPI Documentation](docs/Customer_integration_WEB_SERVICE_CIMAPI_ver13.pdf).

### Error Handling

The SDK throws exceptions for API errors. Always wrap calls in try-catch blocks:

```php
try {
    $response = DhlConnectPlus::createShipment($data);
} catch (\Exception $e) {
    // Handle error
    echo $e->getMessage();
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Smart Dato](https://github.com/Developer)
- [All Contributors](../../contributors)

## License

Propietary
