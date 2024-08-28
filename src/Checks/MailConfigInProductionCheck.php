<?php

namespace Krakero\FireTower\Checks;

use Illuminate\Support\Str;

class MailConfigInProductionCheck extends Check
{
    public $name = 'Mail Config';

    public $send_data = false;

    public function getData(): array
    {
        if (config('mail.mailers') && config('mail.default') && array_key_exists('host', config("mail.mailers")[config("mail.default")])) {
            return [
                'value' => config("mail.mailers")[config("mail.default")]["host"]
            ];
        }

        return [
            'value' => '',
        ];
    }

    public function isOk(): bool
    {
        if (!app()->isProduction()) {
            return true;
        }

        return !Str::contains($this->data['value'], [
            'mailtrap',
            '127.0.0.1',
            'mailtrap',
            'mailpit',
            'mailhog'
        ]);
    }

    public function getStatus($okay): string
    {
        if ($okay) {
            return 'ok';
        }

        return 'Config is showing local or trap host';
    }
}
