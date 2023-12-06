<?php

use App\Http\Controllers\Api\Todo\CompleteController;
use App\Http\Controllers\Api\Todo\CreateController;
use App\Http\Controllers\Api\Todo\DeleteController;
use App\Http\Controllers\Api\Todo\ListController;
use App\Http\Controllers\Api\Todo\ShowController;
use App\Http\Controllers\Api\Todo\UpdateController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'todo'], function () {
    Route::get('list', [ListController::class, '__invoke']);
    Route::get('show', [ShowController::class, '__invoke']);
    Route::get('complete', [CompleteController::class, '__invoke']);
    Route::post('create', [CreateController::class, '__invoke']);
    Route::put('update', [UpdateController::class, '__invoke']);
    Route::delete('delete', [DeleteController::class, '__invoke']);
});
