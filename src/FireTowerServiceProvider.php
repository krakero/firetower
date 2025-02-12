<?php

namespace Krakero\FireTower;

use Krakero\FireTower\Console\Commands\MakeCheck;
use Krakero\FireTower\Console\Commands\Report;
use Krakero\FireTower\Facades\FireTower as FireTowerFacade;
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

        FireTowerFacade::checks(function () {
            return [
                \Krakero\FireTower\Checks\DebugModeInProductionCheck::check(),
                \Krakero\FireTower\Checks\LaravelVersionCheck::check(),
                \Krakero\FireTower\Checks\MailConfigInProductionCheck::check(),
                \Krakero\FireTower\Checks\PhpVersionCheck::check(),
            ];
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
