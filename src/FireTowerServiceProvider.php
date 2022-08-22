<?php

namespace Krakero\FireTower;

use Krakero\FireTower\Commands\Report;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FireTowerServiceProvider extends PackageServiceProvider
{
    public function register()
    {
        parent::register();
        $this->app->bind('firetower', function ($app) {
            return new FireTower();
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('firetower')
            ->hasConfigFile()
            ->hasCommand(Report::class);
    }
}
