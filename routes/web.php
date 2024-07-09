<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\surat;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/signin', [UserController::class, 'signin'])->name('signin');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/denah', [MapController::class, 'index'])->name('denah');
Route::get('/adddenah', [MapController::class, 'create'])->name('adddenah');
Route::post('/storedenah', [MapController::class, 'store'])->name('storedenah');
Route::get('/surat', [surat::class, 'index'])->name('surat');