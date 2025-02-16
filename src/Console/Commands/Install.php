<?php

namespace Krakero\FireTower\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Krakero\FireTower\Checks\ApplicationInfoCheck;
use Krakero\FireTower\Facades\FireTower;

class Install extends Command
{
    public $signature = 'firetower:install';

    public $description = 'Installs Fire Tower';

    public function handle(): int
    {
        $this->components->info('Installing Fire Tower.');

        collect([
            'Service Provider' => fn () => $this->callSilent('vendor:publish', ['--tag' => 'firetower-provider']) == 0,
            'Configuration' => fn () => $this->callSilent('vendor:publish', ['--tag' => 'firetower-config']) == 0,
        ])->each(fn ($task, $description) => $this->components->task($description, $task));

        $this->registerFireTowerServiceProvider();

        $this->components->info('Fire Tower installed successfully.');

        return self::FAILURE;
    }

    public function registerFireTowerServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        if (file_exists($this->laravel->bootstrapPath('providers.php'))) {
            ServiceProvider::addProviderToBootstrapFile("{$namespace}\\Providers\\FireTowerServiceProvider");
        } else {
            $appConfig = file_get_contents(config_path('app.php'));

            if (Str::contains($appConfig, $namespace.'\\Providers\\FireTowerServiceProvider::class')) {
                return;
            }

            file_put_contents(config_path('app.php'), str_replace(
                "{$namespace}\\Providers\EventServiceProvider::class,".PHP_EOL,
                "{$namespace}\\Providers\EventServiceProvider::class,".PHP_EOL."        {$namespace}\Providers\FireTowerServiceProvider::class,".PHP_EOL,
                $appConfig
            ));
        }

        file_put_contents(app_path('Providers/FireTowerServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/FireTowerServiceProvider.php'))
        ));
    }
}
