<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::post('/import', [CustomerController::class, 'import'])->name('import');
Route::get('/customer', [CustomerController::class, 'customer'])->name('customer');
Route::get('/customer-list', [CustomerController::class, 'customer_list'])->name('customer_list');
