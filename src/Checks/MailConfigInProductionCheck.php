<?php

namespace Krakero\FireTower\Checks;

use Illuminate\Support\Str;

class MailConfigInProductionCheck extends Check
{
    public string $name = 'Mail Config';

    public string $description = 'Checks to see if there is a non-production mail config in production';

    public function handle(): string
    {
        $mailers = config('mail.mailers');
        $default = config('mail.default');

        if (app()->isProduction() && $mailers && $default) {

            if ($default === 'log') {
                $this->fail();

                return 'Mail config is set to log';
            }

            if (array_key_exists('host', $mailers[$default])) {
                $host = $mailers[$default]["host"];

                $this->data([
                    'environment' => app()->environment(),
                    'mail_host' => $host,
                ]);

                if ($this->hostIsTrap($host)) {
                    $this->fail();

                    return 'Mail config is set to a trap host';
                }

            }

        }

        $this->pass();

        return 'Mail config looks good';
    }

    public function hostIsTrap($host): bool
    {
        return !Str::contains($host, [
            'mailtrap',
            '127.0.0.1',
            'mailtrap',
            'mailpit',
            'mailhog'
        ]);
    }
}
