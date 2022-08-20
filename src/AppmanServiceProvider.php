<?php

namespace Krakero\Appman;

use Krakero\Appman\Appman;
use Krakero\Appman\Commands\Report;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AppmanServiceProvider extends PackageServiceProvider
{
    public function register()
    {
        parent::register();
        $this->app->bind('appman', function ($app) {
            return new Appman();
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('appman')
            ->hasConfigFile()
            ->hasCommand(Report::class);
    }
}
