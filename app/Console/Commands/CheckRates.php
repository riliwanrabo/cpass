<?php

namespace App\Console\Commands;

use App\Contracts\CurrencyServiceContract;
use App\Models\Watchlist;
use App\Notifications\ThresholdNotification;
use Illuminate\Console\Command;

class CheckRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'watchlist:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Threshold notification trigger';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyServiceContract $contract)
    {
        // This could be cleaned up but bcos of limited time
        $baseCurrency = auth()->user()->setting->currency;
        $rates = $contract->rates($baseCurrency->symbol);

        $watchlist = Watchlist::query()->where('user_id', auth()->id())->get();
        foreach ($watchlist as $watch) {
            foreach ($rates as $rate) {
                if ($rate === $watch->symbol && $rate < $watch->rate) {
                    // notify user
                    auth()->user()->notify(new ThresholdNotification($watch->symbol, $watch->rate));
                }
            }
        }
    }
}
