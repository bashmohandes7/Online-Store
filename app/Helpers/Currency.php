<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public static function format($amount, $currency = null)
    {
        $formattwer = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        if ($currency === null) {
            $currency = 'USD';
        }
        return $formattwer->formatCurrency($amount, $currency);
    } // end of format
} // end of class Currency
