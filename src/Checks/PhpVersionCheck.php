<?php

namespace Krakero\FireTower\Checks;

class PhpVersionCheck extends Check
{
    public string $name = 'PHP Version';

    public string $description = 'Collects the PHP version for server side checks';

    public function handle(): string
    {
        $this->pass();

        $this->data([
            'php_version' => $ver = phpversion(),
        ]);

        return $ver;
    }
}
