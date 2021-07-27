<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CharactersController;
use App\Http\Controllers\API\EpisodesController;
use App\Http\Controllers\API\QuotesController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('episodes', EpisodesController::class);
    Route::resource('characters', CharactersController::class);
    Route::resource('quotes', QuotesController::class);

    Route::post('characters/random', [CharactersController::class, 'random']);
    Route::post('quotes/random', [QuotesController::class, 'random']);
});
