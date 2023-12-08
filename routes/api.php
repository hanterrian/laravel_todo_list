<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Task\CompleteController;
use App\Http\Controllers\Api\Task\CreateController;
use App\Http\Controllers\Api\Task\DeleteController;
use App\Http\Controllers\Api\Task\ListController;
use App\Http\Controllers\Api\Task\ShowController;
use App\Http\Controllers\Api\Task\UpdateController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, '__invoke']);

    Route::post('logout', [LogoutController::class, '__invoke'])
        ->middleware(['auth:sanctum']);
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'todo'], function () {
    Route::get('list', [ListController::class, '__invoke']);
    Route::get('show/{id}', [ShowController::class, '__invoke']);
    Route::get('complete/{id}', [CompleteController::class, '__invoke']);
    Route::post('create', [CreateController::class, '__invoke']);
    Route::put('update/{id}', [UpdateController::class, '__invoke']);
    Route::delete('delete', [DeleteController::class, '__invoke']);
});
