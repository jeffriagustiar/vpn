<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\VpnController;
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

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home_admin', [HomeController::class, 'index'])->name('home-admin');

    //Paket
    Route::get('/paket', [PaketController::class, 'index'])->name('list-paket');
    Route::get('/get-paket', [PaketController::class, 'show']);
    Route::post('/add-paket', [PaketController::class, 'store']);
    Route::post('/update-paket/{id}', [PaketController::class, 'edit']);
    Route::delete('/delete-paket/{id}', [PaketController::class, 'destroy']);
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/home_user', [HomeController::class, 'index_user'])->name('home-user');

    //VPN
    Route::get('/vpn', [VpnController::class, 'index'])->name('list-vpn');
    Route::get('/get-vpn', [VpnController::class, 'show']);
    Route::post('/add-vpn', [VpnController::class, 'store']);
    Route::post('/update-vpn/{id}', [VpnController::class, 'edit']);
    Route::delete('/delete-vpn/{id}', [VpnController::class, 'destroy']);
});
