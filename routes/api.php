<?php

use App\Http\Controllers\Api\LoanApplicationController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {
    Route::post('calculator', [LoanApplicationController::class, 'calculate']);
});
