<?php

use App\Http\Controllers\DocumentController;
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
Route::get('/viewdenah', [MapController::class, 'index'])->name('viewdenah');
Route::resource('denah', MapController::class);
Route::get('/adddenah', [MapController::class, 'create'])->name('adddenah');
Route::post('/storedenah', [MapController::class, 'store'])->name('storedenah');
Route::delete('/denah/{id}', [MapController::class, 'destroy'])->name('deletedenah');


// Document
Route::get('/document', [DocumentController::class, 'index'])->name('Document');

Route::get('/viewdocument', [DocumentController::class, 'index'])->name('viewdocument');
Route::get('/adddocument', [DocumentController::class, 'create'])->name('adddocument');
Route::post('/storedocument', [DocumentController::class, 'store'])->name('storedocument');
Route::delete('/document/{id}', [DocumentController::class, 'destroy'])->name('deletedocument');

