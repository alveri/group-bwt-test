<?php

namespace App\Helpers;

class AmountCalculator
{
    private const EUR = 'EUR';

    public static function calculate(float $amount, float $rate, string $currency, bool $isEuro): float
    {
        if ($currency == self::EUR || $rate == 0) {
            $amntFixed = $amount;
        }
        if ($currency != 'EUR' || $rate > 0) {
            $amntFixed = $amount / $rate;
        }

        return round($amntFixed * ($isEuro ? 0.01 : 0.02), 2);
    }
}