<?php

use Illuminate\Http\Request;

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

Route::get('/health', 'GatewayController@health');

Route::middleware('gw.auth')->prefix('v1')->group(function () {
    // 1 pintu untuk drive (cached 10 menit di controller)
    Route::get('/drive/list', 'GatewayController@driveList');

    // 1 pintu untuk SO AO -> Transaksi (teruskan X-API-KEY + Idempotency-Key)
    Route::post('/trans/so-awal/store', 'GatewayController@transSoStore');
});
