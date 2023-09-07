<?php

use App\Http\Controllers\api\province_controller;
use App\Http\Controllers\api\city_controller;
use App\Http\Controllers\api\auth_controller;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [auth_controller::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('search/provinces', [province_controller::class, 'show']);
    Route::get('search/cities', [city_controller::class, 'show']);
    Route::post('logout', [auth_controller::class, 'logout']);
});
