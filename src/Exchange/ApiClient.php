<?php

namespace App\Exchange;

class ApiClient implements ExchangeClientInterface
{
    private const API_KEY = '3j5ovZyRr2BYqPkRix2H8SNyhLPsE1dA';

    public function getExchangeRate(string $currency): ?float
    {
        $request_headers = [
            'apikey:' . self::API_KEY,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.apilayer.com/exchangerates_data/latest');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
           return null;
        }
        curl_close($ch);
        $data = json_decode($response, true);

        if ($data['success'] === false) {
            return null;
        }

        return $data['rates'][$currency];
    }
}