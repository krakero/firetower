<?php

namespace Krakero\FireTower\Checks;

class Check
{
    public string $name;

    public string $description;

    public bool $ok;

    public $message;

    public array $data;

    public bool $notify_on_failure = true;

    public function report(): self
    {
        $this->message = $this->handle();
        $this->data = $this->data ?? [];
        $this->ok = $this->ok ?? false;

        return $this;
    }

    protected function handle(): string
    {
        $this->pass();

        return 'it works';
    }

    protected function pass(): self
    {
        $this->ok = true;

        return $this;
    }

    protected function fail(): self
    {
        $this->ok = false;

        return $this;
    }

    public function data(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function dontNotify(): self
    {
        $this->notify_on_failure = false;

        return $this;
    }

    public static function check()
    {
        $instance = new static();

        return new $instance();
    }
}
