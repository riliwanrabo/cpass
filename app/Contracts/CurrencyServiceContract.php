<?php

namespace App\Contracts;

interface CurrencyServiceContract
{
    /*
     * Fetches supported symbols
     */
    public function symbols();

    /*
     * Fetches rates from third party
     */
    public function rates($symbol);
}
