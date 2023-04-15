<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ClientController;

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

Route::post('/login', [ApiAuthController::class, 'login']);

Route::post('/client/register', [ClientController::class, 'register']);
Route::post('/client/updateBasicInformation', [ClientController::class, 'updateBasicInformation']);
Route::post('/client/updateReport', [ClientController::class, 'updateReport']);







