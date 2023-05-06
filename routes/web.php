<?php

use App\Http\Controllers\DesaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/home');
});

Auth::routes([
    'register' => env('APP_DEBUG', false), // Registration Routes...
    'reset' =>  env('APP_DEBUG', false), // Password Reset Routes...
    'verify' =>  env('APP_DEBUG', false), // Email Verification Routes...
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('desa', DesaController::class);
Route::resource('periode', PeriodeController::class);
Route::resource('kelahiran', KelahiranController::class);
Route::resource('user', UserController::class);
Route::get('/rekap', [HomeController::class, 'rekap'])->name('rekap');
