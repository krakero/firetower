<?php

namespace Krakero\FireTower\Checks;

use Illuminate\Support\Str;

class MailConfigInProductionCheck extends Check
{
    public $name = 'Mail Config';

    public function getData(): array
    {
        return [
            'value' => config("mail.mailers")[config("mail.default")]["host"]
        ];
    }

    public function isOk($data): bool
    {
        if (!app()->isProduction()) {
            return true;
        }

        return !Str::contains($data['value'], [
            'mailtrap',
            '127.0.0.1',
            'mailtrap',
            'mailpit',
            'mailhog'
        ]);
    }
}
