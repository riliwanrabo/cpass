<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
    Route::get('/', [App\Http\Controllers\CurrencyController::class, 'index'])->name('index');
    Route::post('/', [App\Http\Controllers\CurrencyController::class, 'setBaseCurrency'])->name('setBase');
    Route::post('/watchlist', [App\Http\Controllers\CurrencyController::class, 'setThreshold'])->name('setThreshold');
    Route::get('/rates/{symbol}', [App\Http\Controllers\CurrencyController::class, 'fetchRates'])->name('rates');
});

