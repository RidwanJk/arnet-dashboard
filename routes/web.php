<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\surat;

Route::get('/denah', [DashboardController::class, 'index'])->name('denah');
Route::get('/surat', [surat::class, 'index'])->name('surat');
Route::get('/form', [DashboardController::class, 'showForm'])->name('formdenah');
Route::get('/login', [LoginController::class, 'index'])->name('login');


// Add other routes as needed
