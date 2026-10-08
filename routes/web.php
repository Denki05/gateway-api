<?php

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

Route::get('/login', 'AuthController@loginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::middleware('admin.auth')->group(function () {
    Route::get('/', 'GatewayController@dashboard');
    Route::get('/services-status', 'GatewayController@servicesStatus');
    Route::get('/settings', 'SettingsController@show');
    Route::post('/settings', 'SettingsController@save');
    Route::get('/help', 'GatewayController@help');
    Route::get('/routes', 'GatewayController@routes');
    Route::get('/cutover', 'CutoverController@show');
    Route::post('/cutover', 'CutoverController@save');
    Route::post('/test-endpoint', 'GatewayController@testEndpoint');
});
