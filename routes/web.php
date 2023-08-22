<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
//    Route::resource('service', 'ServiceController')->only();
});

Route::get('test/{slug}', \App\Livewire\Test::class)->name('test');
Route::get('create-order', \App\Livewire\Order\CreateOrder::class);
