<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BackViewController;
use App\Http\Controllers\Admin\InfoPersonalController;
use App\Http\Controllers\Admin\InfoRelatedController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/coming_soon', function () {
    return view('coming_soon');
})->name('coming_soon');

Route::middleware([ 'auth:sanctum','verified','member', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', [BackViewController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

Route::resource('info_personal', InfoPersonalController::class);
Route::resource('info_related', InfoRelatedController::class);