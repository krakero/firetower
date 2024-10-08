<?php

namespace Krakero\FireTower\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Krakero\FireTower\Checks\ApplicationInfoCheck;

class Report extends Command
{
    public $signature = 'firetower:report';

    public $description = 'Reports data to your server';

    public $requiredChecks = [
        ApplicationInfoCheck::class,
    ];

    public function handle(): int
    {
        $this->info('Starting Report');

        $url = config('firetower.server_url') . '/api/report/' . config('firetower.account_key') . '/' . config('firetower.application_key');

        $data = collect(config('firetower.enabled_checks'))
            ->merge($this->requiredChecks)
            ->map(function ($check) {
                return new $check();
            })
            ->map(function ($check) {
                $check->handle();

                return [
                    'name' => $check->name,
                    'description' => $check->description,
                    'class' => get_class($check),
                    'data' => $check->send_data ? $check->data : null,
                    'status' => $check->status,
                    'is_ok' => $check->ok,
                    'notify' => $check->notify_on_failure,
                ];
            })
            ->toArray();

        $this->line('Sending Data');

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
