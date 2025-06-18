<?php

namespace App\Services;

class CurrencyConverter
{
    private array $rates = [
        'USD' => [
            'EUR' => 0.85,
            'GBP' => 0.73,
            'JPY' => 110.0,
            'USD' => 1.0
        ],
        'EUR' => [
            'USD' => 1.18,
            'GBP' => 0.86,
            'JPY' => 129.4,
            'EUR' => 1.0
        ],
        'GBP' => [
            'USD' => 1.37,
            'EUR' => 1.16,
            'JPY' => 150.7,
            'GBP' => 1.0
        ],
        'JPY' => [
            'USD' => 0.0091,
            'EUR' => 0.0077,
            'GBP' => 0.0066,
            'JPY' => 1.0
        ]
    ];

    public function convert(float $amount, string $from, string $to): float
    {
        $from = strtoupper($from);
        $to = strtoupper($to);

        if (!isset($this->rates[$from]) || !isset($this->rates[$from][$to])) {
            throw new \InvalidArgumentException("Unsupported currency conversion: {$from} to {$to}");
        }

        return $amount * $this->rates[$from][$to];
    }
} 