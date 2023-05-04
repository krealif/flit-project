<?php

use App\Http\Controllers\FlitController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

Route::middleware(['throttle:ip_address', ProtectAgainstSpam::class])
->controller(FlitController::class)
->group(function () {
    Route::get('/', 'index')->name('flit.index');
    Route::post('/', 'store')->name('flit.store');

    Route::where(['flit' => '^[a-zA-Z0-9]{8}$'])->group(function () {
        Route::delete('/d/{flit}', 'destroy')->name('flit.destroy');
        Route::get('/{flit}', 'show');
        Route::post('/{flit}', 'download')->name('flit.download');
    });

    Route::get('/result', 'result');
});
