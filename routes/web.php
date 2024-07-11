<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\surat;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisioController;

Route::get('/', function () {
    return redirect('/login');
});

//Auth
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/signin', [UserController::class, 'signin'])->name('signin');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');

// Map
Route::get('/denah', [MapController::class, 'index'])->name('denah');
Route::resource('denah', MapController::class);
Route::get('/adddenah', [MapController::class, 'create'])->name('adddenah');
Route::post('/storedenah', [MapController::class, 'store'])->name('storedenah');
Route::delete('/delete/{id}', [MapController::class, 'create'])->name('deletedenah');
Route::get('/preview/{id}', [MapController::class, 'preview'])->name('preview');


// Surat
Route::get('/surat', [surat::class, 'index'])->name('surat');

