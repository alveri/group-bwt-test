<?php

namespace App\Input;

class AmountDto
{
    public float $amount;

    public function __construct(float $amount, public string $currency, public string $bin)
    {
        $this->amount = round($amount, 2); ;
    }
}