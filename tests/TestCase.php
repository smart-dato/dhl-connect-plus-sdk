<?php

namespace SmartDato\DhlConnectPlusClient\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use SmartDato\DhlConnectPlusClient\DhlConnectPlusClientServiceProvider;
use Spatie\LaravelData\Normalizers\ArrayableNormalizer;
use Spatie\LaravelData\Normalizers\ArrayNormalizer;
use Spatie\LaravelData\Normalizers\JsonNormalizer;
use Spatie\LaravelData\Normalizers\ModelNormalizer;
use Spatie\LaravelData\Normalizers\ObjectNormalizer;
use Spatie\LaravelData\Support\Creation\ValidationStrategy;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'SmartDato\\DhlConnectPlusClient\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DhlConnectPlusClientServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        config()->set('dhl-connect-plus-sdk.base_url', 'https://external.dhl.es/cimapi/api/v1/customer');

        config()->set('data.validation_strategy', ValidationStrategy::OnlyRequests->value);
        config()->set('data.normalizers', [
            ModelNormalizer::class,
            ArrayableNormalizer::class,
            ObjectNormalizer::class,
            ArrayNormalizer::class,
            JsonNormalizer::class,
        ]);
        config()->set('data.max_transformation_depth', 512);
        config()->set('data.throw_when_max_transformation_depth_reached', 512);

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
