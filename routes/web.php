<?php

use App\Http\Controllers\CustomersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [CustomersController::class, 'index']);

Route::post('/create', [CustomersController::class, 'store']);
Route::get('/show/{id}', [CustomersController::class, 'show']);
Route::post('/update/{id}', [CustomersController::class, 'update']);
Route::get('/delete/{id}', [CustomersController::class, 'delete']);
