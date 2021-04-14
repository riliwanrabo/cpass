<?php

use App\Http\Controllers\Api\LoanApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json([
    'success' => true,
    'data' => [],
    'message' => 'Calculator app is ready without issues'
], 200));

Route::group(['namespace' => 'Api'], function () {
    Route::post('calculator', [LoanApplicationController::class, 'calculate']);
});
