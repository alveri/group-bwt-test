<?php

namespace App\Bin;

class LookupClient implements BinClientInterface
{
    public function getAlpha2(string $bin): ?string
    {
        $binResults = file_get_contents('https://lookup.binlist.net/' . $bin);
        if (!$binResults)
            return null;

        $r = json_decode($binResults);

        try {
            return $r->country->alpha2;
        } catch (\Exception $e) {
            return null;
        }
    }
}