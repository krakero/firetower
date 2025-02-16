<?php

namespace Krakero\FireTower;

use Krakero\FireTower\Console\Commands\Install;
use Krakero\FireTower\Console\Commands\MakeCheck;
use Krakero\FireTower\Console\Commands\Report;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FireTowerServiceProvider extends PackageServiceProvider
{
    public function register()
    {
        parent::register();
        $this->app->singleton('firetower', function ($app) {
            return new FireTower();
        });
    }

    public function boot()
    {
        parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('firetower')
            ->hasConfigFile()
            ->publishesServiceProvider('FireTowerServiceProvider')
            ->hasCommand(Install::class)
            ->hasCommand(MakeCheck::class)
            ->hasCommand(Report::class);
    }
}
