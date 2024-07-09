<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\surat;
use App\Http\Controllers\UserController;

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
Route::get('/form', [MapController::class, 'create'])->name('formdenah');
Route::delete('/delete/{id}', [MapController::class, 'create'])->name('deletedenah');


// Surat
Route::get('/surat', [surat::class, 'index'])->name('surat');



// Add other routes as needed

