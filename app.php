<?php

require __DIR__ . '/vendor/autoload.php';

use App\Input\FileInputParser;
use App\Bin\LookupClient;
use App\Helpers\EuDefiner;
use App\Helpers\AmountCalculator;
use App\Exchange\ApiClient;

$parser = new FileInputParser;
$amounts = $parser->parse($argv[1]);

$lookupClient = new LookupClient;
$exchangeClient = new ApiClient;

/** @var \App\Input\AmountDto $amount */
foreach ($amounts as $amount) {
    $countryCode = $lookupClient->getAlpha2($amount->bin);

    if (is_null($countryCode)) {
        continue;
    }

    $isEu = EuDefiner::isEU($countryCode);
    $rate = $exchangeClient->getExchangeRate($amount->currency);

    if (is_null($rate)) {
        continue;
    }

    echo AmountCalculator::calculate($amount->amount, $rate, $amount->currency, $isEu);
    print "\n";
}
