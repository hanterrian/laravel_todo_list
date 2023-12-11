<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Task\CompleteController;
use App\Http\Controllers\Api\Task\CreateController;
use App\Http\Controllers\Api\Task\DeleteController;
use App\Http\Controllers\Api\Task\ListController;
use App\Http\Controllers\Api\Task\ShowController;
use App\Http\Controllers\Api\Task\UpdateController;
use App\Http\Controllers\Api\TasksController;
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

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'tasks'], function () {
    Route::patch('complete/{id}', [TasksController::class, 'complete']);
});

Route::apiResource('tasks', TasksController::class, [
    'middleware' => ['auth:sanctum'],
]);
