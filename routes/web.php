<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'employee'], function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/create', [EmployeeController::class, 'create']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::get('/create_ajax', [EmployeeController::class, 'create_ajax']);
    Route::post('/ajax', [EmployeeController::class, 'store_ajax']);
    Route::get('/{id}', [EmployeeController::class, 'show']);
    Route::get('/{id}/edit', [EmployeeController::class, 'edit']);
    Route::put('/{id}', [EmployeeController::class, 'update']);
    Route::get('/{id}/edit_ajax', [EmployeeController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [EmployeeController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [EmployeeController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [EmployeeController::class, 'delete_ajax']);
    Route::delete('/{id}', [EmployeeController::class, 'destroy']);
});
