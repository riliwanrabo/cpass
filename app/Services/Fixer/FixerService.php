<?php

namespace App\Services\Fixer;

use App\Contracts\CurrencyServiceContract;
use App\Models\Currency;
use App\Traits\CurlTrait;
use Illuminate\Support\Arr;

class FixerService implements CurrencyServiceContract
{
    use CurlTrait;

    private const SUCCESS = true;
    // todo: move to Currency Trait
    private const BASE_CURRENCY = 'EUR';

    protected string $base_url;
    protected string $key;

    public function __construct(private string $baseCurrency = self::BASE_CURRENCY)
    {
        $this->base_url = env('FIXER_BASE_URL');
        $this->key = env('FIXER_API_KEY');
    }

    public function symbols()
    {
        $currencies = Currency::all();
        if ($currencies->count() <= 0) {
            $endpoint = $this->base_url . '/symbols';
            $response = $this->getApi($endpoint, ['access_key' => $this->key,])->json();

            if (!$response['success']) {
                throw new \RuntimeException('Could not fetch symbols');
            }
            foreach ($response['symbols'] as $key => $symbol) {
                // store in table
                $currency = new Currency();
                $currency->symbol = $key;
                $currency->description = $symbol;
                $currency->save();
            }

            return Currency::all();
        }

        return $currencies;
    }

    public function rates($symbol)
    {
        $endpoint = $this->base_url . '/latest';
        $response = $this->getApi($endpoint, [
            'access_key' => $this->key,
            'base' => $symbol ?? $this->baseCurrency,
        ])->json();


        if (!$response['success']) {
            throw new \RuntimeException('Could not fetch rates for ' . $symbol. '. Try setting base currency to EUR');
        }
        return $response['rates'];
    }


}
