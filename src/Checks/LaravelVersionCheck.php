<?php

namespace Krakero\FireTower\Checks;

class LaravelVersionCheck extends Check
{
    public string $name = 'Laravel Version';

    public string $description = 'Gathers Laravel version for server side evaluation';

    public function handle(): string
    {
        $this->pass();

        $this->data([
            'laravel_version' => $ver = app()->version(),
        ]);

        return $ver;
    }
}
