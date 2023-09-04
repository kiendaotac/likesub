<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Apis\V1', 'prefix' => 'v1'], function () {
    Route::apiResources([
        'order'             => 'OrderController',
        'distribution'      => 'DistributionController',
        'list-distribution' => 'DistributionListController'
    ]);
})->middleware(\App\Http\Middleware\ApiAuth::class);
