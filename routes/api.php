<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TodoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::resource('/divisions', DivisionController::class);
Route::post('/divisions/{id}', [DivisionController::class, 'update']);

Route::resource('/departments', DepartmentController::class);
Route::post('/departments/{id}', [DepartmentController::class, 'update']);

Route::resource('/positions', PositionController::class);
Route::post('/positions/{id}', [PositionController::class, 'update']);

Route::resource('/careers', CareerController::class);
Route::post('/careers/{id}', [CareerController::class, 'update']);
