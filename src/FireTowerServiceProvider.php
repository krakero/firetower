<?php

namespace Krakero\FireTower;

use Krakero\FireTower\Console\Commands\MakeCheck;
use Krakero\FireTower\Console\Commands\Report;
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
            ->hasCommand(MakeCheck::class)
            ->hasCommand(Report::class);
    }
}
