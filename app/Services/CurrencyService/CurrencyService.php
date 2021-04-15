<?php

namespace App\Services\CurrencyService;

use App\Contracts\CurrencyServiceContract;
use App\Enums\Vendor;
use App\Services\Fixer\FixerService;

class CurrencyService implements CurrencyServiceContract
{

    /**
     * @var FixerService
     */
    private FixerService $currencyService;

    public function __construct(public string $service)
    {
        // SWITCH SERVICES HERE
        $this->currencyService = new FixerService();
    }

    public function symbols()
    {
        return $this->currencyService->symbols();
    }

    public function rates($symbol)
    {
        return $this->currencyService->rates($symbol);
    }
}
