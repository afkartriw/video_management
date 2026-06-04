<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\RequestController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('video', VideoController::class);    
    Route::resource('request', RequestController::class);      
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('customer', CustomerController::class);    
});

// dashboard pages
Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';