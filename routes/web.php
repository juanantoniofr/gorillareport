<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// pc clients routes

Route::get('clients', 'App\Http\Controllers\ClientController@index')->middleware('auth')->name('clients');
Route::get('clients/{client}', 'App\Http\Controllers\ClientController@show')->middleware('auth')->name('clients.show');
Route::get('clients/report/{client}', 'App\Http\Controllers\ClientController@show_report')->middleware('auth')->name('clients.show_report');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});