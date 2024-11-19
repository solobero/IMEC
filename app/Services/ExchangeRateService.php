<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    public function getExchangeRate(): string
    {
        $response = Http::get('https://api.exchangeratesapi.io/v1/latest', [
            'access_key' => 'caf89c0340f14af6b72d0e9c1b71c42a',
            'symbols' => 'COP',
        ]);

        if ($response->successful() && isset($response->json()['rates']['COP'])) {
            return $response->json()['rates']['COP'];
        }

        return 'Unavailable';
    }
}
