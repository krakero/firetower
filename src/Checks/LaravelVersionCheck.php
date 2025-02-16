<?php

namespace Krakero\FireTower\Checks;

class LaravelVersionCheck extends Check
{
    public string $name = 'Laravel Version';

    public string $description = 'Gathers Laravel version for server side evaluation';

    public bool $only_major = false;

    public bool $only_minor = false;

    public function handle(): string
    {
        $this->pass();

        $this->data([
            'laravel_version' => $ver = app()->version(),
            'only_major' => $this->only_major,
            'only_minor' => $this->only_minor,
        ]);

        return $ver;
    }

    public function onlyMajor()
    {
        $this->only_major = true;

        return $this;
    }

    public function onlyMinor()
    {
        $this->only_minor = true;

        return $this;
    }
}
