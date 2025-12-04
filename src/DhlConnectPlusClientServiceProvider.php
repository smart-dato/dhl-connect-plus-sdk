<?php

namespace SmartDato\DhlConnectPlusClient;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DhlConnectPlusClientServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('dhl-connect-plus-sdk')
            ->hasConfigFile();
    }
}
