<?php

namespace App\Http\Controllers;

use App\Contracts\CurrencyServiceContract;
use App\Models\Currency;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(CurrencyServiceContract $currencyServiceContract)
    {
        try {
            $data = $currencyServiceContract->symbols();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $userSetting = UserSetting::query()->where('user_id', auth()->id())->first();
        $currency = Currency::query()->where('symbol', 'EUR')->first();
        if (!$userSetting) {
            $this->createDefaultBaseCurrency($currency->id);
        }
        $baseCurrency = auth()->user()->setting->currency ?? null;


        return view('currencies.index', compact('data', 'baseCurrency'));
    }

    public function fetchRates($symbol, CurrencyServiceContract $currencyServiceContract)
    {
        try {
            $data = $currencyServiceContract->rates($symbol);
        } catch (\Exception $e) {
            return redirect()->route('currency.index')->with('status', $e->getMessage());
        }

        $baseCurrency = auth()->user()->setting->currency ?? null;
        return view('currencies.rates', compact('data', 'baseCurrency'));
    }

    public function setBaseCurrency(Request $request)
    {
        $this->validate($request, [
            'currency_id' => ['required', 'exists:currencies,id']
        ]);

        $userSetting = UserSetting::where('user_id', auth()->id())->first();
        if (!$userSetting) {
            $this->createDefaultBaseCurrency($request->get('currency_id'));
            return redirect()->route('currency.index')->with('status', 'Base currency has been set');
        }

        $userSetting->update([
            'currency_id' => $request->get('currency_id')
        ]);

        return redirect()->route('currency.index')->with('status', 'Base currency has been updated');

    }

    private function createDefaultBaseCurrency($currencyId)
    {
        $user = auth()->user();
        $user->setting()->create([
            'currency_id' => $currencyId
        ]);

        return $user->setting;
    }
}
