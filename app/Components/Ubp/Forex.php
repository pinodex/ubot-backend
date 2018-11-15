<?php

namespace App\Components\Ubp;

use App\Components\Ubp\Forex\InvalidCurrencyException;
use App\Components\Ubp\Forex\Conversion;

class Forex {

    /**
     * UBP instance
     *
     * @var Ubp
     */
    private $ubp;

    /**
     * Rates
     *
     * @var array
     */
    private $rates;

    public function __construct(Ubp $ubp)
    {
        $this->ubp = $ubp;
    }

    public function loadRates()
    {
        $response = $this->ubp->getClient()->get('forex/v1/rates');

        $this->rates = json_decode($response->getBody(), true);
    }

    /**
     * Convert currency
     *
     * @param  string $sourceCurrency Source currency symbol
     * @param  string $destCurrency   Destination currency symbol
     * @param  double $amount         Amount to convert
     * @return Forex\Conversion
     */
    public function convert($sourceCurrency, $destCurrency, $amount)
    {
        if (!$this->isCurrencyValid($sourceCurrency) ||
            !$this->isCurrencyValid($destCurrency)) {
            throw new InvalidCurrencyException;
        }

        $exchangeRate = $this->getExchangeRate($sourceCurrency);
        $rate = $exchangeRate['buying'];

        if (!$this->isPhp($destCurrency)) {
            $exchangeRateDest = $this->getExchangeRate($destCurrency);
            $rate = $exchangeRate['buying'] / $exchangeRateDest['selling'];
        }

        $value = $amount * $rate;

        return new Conversion($sourceCurrency, $destCurrency, $amount,
            $value, $rate, $exchangeRate['asOf']);
    }

    private function isCurrencyValid($code)
    {
        if ($this->isPhp($code)) return true;

        foreach ($this->rates as $rate) {
            if (strtolower($code) == strtolower($rate['symbol'])) {
                return true;
            }
        }

        return false;
    }

    private function isPhp($code)
    {
        return strtolower($code) == 'php';
    }

    private function getExchangeRate($code)
    {
        foreach ($this->rates as $rate) {
            if ($code == $rate['symbol']) {
                return $rate;
            }
        }

        throw new InvalidCurrencyException;
    }

}
