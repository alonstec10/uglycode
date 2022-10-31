<?php

use App\Http\Controllers\TickerExchangeController;
use App\Http\Controllers\TickersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('exchange', TickerExchangeController::class);
Route::resource('exchange.ticker', TickerExchangeController::class);
Route::resource('ticker', TickersController::class);