<?php

namespace Krakero\FireTower\Checks;

class Check
{
    public $name = '';

    public $description = null;

    public $notify_on_failure = true;

    public $send_data = true;

    public $ok = false;

    public $data = [];

    public $status = 'error';

    public function handle(): void
    {
        $this->data = $this->getData();
        $this->name = $this->getName();
        $this->ok = $this->isOk();
        $this->status = $this->getStatus($this->ok);
    }

    public function getData(): array
    {
        return [];
    }

    public function getName(): string
    {
        if ($this->name) {
            return $this->name;
        }

        return get_class($this);
    }

    public function isOk(): bool
    {
        return false;
    }

    public function getStatus($okay): string
    {
        return $okay ? 'ok' : $this->name . ' is not okay.';
    }
}
