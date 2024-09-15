<?php

namespace App\Bin;

interface BinClientInterface
{
    public function getAlpha2(string $bin): ?string;
}