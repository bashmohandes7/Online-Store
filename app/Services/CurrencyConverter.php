<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey = 'f553bc9f70be4950b53861c235837213';
    protected $baseUrl = 'https://api.currencyfreaks.com/latest';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    } // end of constructor
    public function convert($rates,  $amount = 1)
    {
        $response = Http::baseUrl($this->baseUrl)
            ->get('/convert', [
                'apikey' => $this->apiKey,
                'rates' => $this->rates
            ]);
        $result = $response->json();
        return $result['symbols'] * $amount;
    }
}
