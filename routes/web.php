<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/table', [DashboardController::class, 'showTable'])->name('table');
Route::get('/form', [DashboardController::class, 'showForm'])->name('form');

// Add other routes as needed
