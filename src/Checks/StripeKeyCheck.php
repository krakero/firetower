<?php

namespace Krakero\FireTower\Checks;

class StripeKeyCheck extends Check
{
    public string $name = 'Check Stripe Keys';

    public string $description = 'Checks if the Stripe keys in use are test keys';

    public function handle(): string
    {
        $isProduction = app()->isProduction();
        $hasCashierConfig = (bool) config('cashier');

        if ($isProduction && $hasCashierConfig) {
            $secret = config('cashier.secret');
            $key = config('cashier.key');

            if (str_contains($secret, 'sk_test') || str_contains($key, 'pk_test')) {
                $this->fail();
                $this->data([
                    'is_production' => $isProduction,
                    'test_keys_present' => true,
                    'has_cashier_config' => $hasCashierConfig,
                ]);;

                return 'Stripe test keys present in production';
            }
        }

        $this->pass();

        $this->data([
            'is_production' => $isProduction,
            'has_cashier_config' => $hasCashierConfig,
            'test_keys_present' => false,
        ]);

        return 'PASS';
    }
}
