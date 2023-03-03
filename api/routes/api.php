<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [CustomerController::class, 'getCustomers'])->middleware('cors');
Route::get('/customers', [CustomerController::class, 'searchCustomers']);
Route::get('/customers/{customer_id}', [CustomerController::class, 'getCustomer']);
Route::post('/customers', [CustomerController::class, 'createCustomer']);
Route::put('/customers/{customer_id}', [CustomerController::class, 'updateCustomer']);
Route::delete('/customers/{customer_id}', [CustomerController::class, 'deleteCustomer']);