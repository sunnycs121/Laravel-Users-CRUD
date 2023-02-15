<?php

use App\Http\Controllers\Api\ApiUserController;
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

// Route::apiResource('users', UserController::class);

Route::prefix('users')
    ->name('users.')
    ->group(function () {
        Route::get('/', [ApiUserController::class, 'index'])->name('index');
        Route::post('/', [ApiUserController::class, 'store'])->name('store');
        Route::get('/{user}', [ApiUserController::class, 'show'])->name('show');
        Route::put('/{user}', [ApiUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [ApiUserController::class, 'destroy'])->name('destroy');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
