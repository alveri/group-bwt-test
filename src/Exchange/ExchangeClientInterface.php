<?php

namespace App\Exchange;

interface ExchangeClientInterface
{
    public function getExchangeRate(string $currency): ?float;
}