<?php

namespace Krakero\FireTower\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Krakero\FireTower\Checks\ApplicationInfo;

class Report extends Command
{
    public $signature = 'firetower:report';

    public $description = 'Reports data to your server';

    public $requiredChecks = [
        ApplicationInfo::class,
    ];

    public function handle(): int
    {
        $url = config('firetower.server_url').'/api/report/'.config('firetower.account_key').'/'.config('firetower.application_key');

        $data = collect(config('firetower.enabled_checks'))
            ->merge($this->requiredChecks)
            ->map(function ($check) {
                return new $check();
            })
            ->map(function ($check) {
                $value = $check->getValue();

                return [
                    'name' => $check->getName(),
                    'class' => get_class($check),
                    'value' => $value,
                    'is_ok' => $check->isOk($value),
                    'notify' => $check->notify_on_failure,
                ];
            })
            ->toArray();

        $response = Http::post($url, $data);

        if ($response->successful()) {
            $this->comment('Report Complete');

            return self::SUCCESS;
        }

        $this->error('Report Failed');
        $this->line('');

        if ($response->json() && array_key_exists('message', $response->json())) {
            $this->error($response->json()['message']);
        } else {
            $this->error($response->body());
        }

        return self::FAILURE;
    }
}
