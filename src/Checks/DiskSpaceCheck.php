<?php

namespace Krakero\FireTower\Checks;

use Illuminate\Support\Number;

class DiskSpaceCheck extends Check
{
    public string $name = 'Check Disk Space';

    public string $description = 'Check the specified drive disk and compare against the threshold';

    public string $drive = '/';

    public int $threshold = 5 * 1024 * 1024 * 1024;

    public function handle(): string
    {
        $space = disk_free_space($this->drive);

        if ($space > $this->threshold) {
            $this->pass();
        } else {
            $this->fail();
        }

        $available_space = Number::fileSize($space);

        $this->data([
            'available_space' => $available_space,
            'threshold' => Number::fileSize($this->threshold),
            'drive' => $this->drive,
        ]);

        return 'Space Available: ' . $available_space;
    }

    public function drive($string)
    {
        $this->drive = $string;

        return $this;
    }

    public function threshold($number)
    {
        $this->threshold = $number;

        return $this;
    }

    public function minMB($megabytes)
    {
        $this->threshold($megabytes * 1024 * 1024);

        return $this;
    }

    public function minGB($gigabytes)
    {
        $this->threshold($gigabytes * 1024 * 1024 * 1024);

        return $this;
    }

    public function minTB($terrabyte)
    {
        $this->threshold($terrabyte * 1024 * 1024 * 1024 * 1024);

        return $this;
    }
}
