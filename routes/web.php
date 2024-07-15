<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\surat;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfNotAuthenticated;

Route::get('/', function () {
    return redirect('/login');
});

//Auth
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/signin', [UserController::class, 'signin'])->name('signin');

Route::get('/register', [UserController::class, 'register'])->name('register')->middleware(RedirectIfNotAuthenticated::class);;
Route::post('/signup', [UserController::class, 'signup'])->name('signup');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Map
Route::get('/viewdenah', [MapController::class, 'index'])->name('viewdenah')->middleware(RedirectIfNotAuthenticated::class);;
Route::resource('denah', MapController::class)->middleware(RedirectIfNotAuthenticated::class);;
Route::get('/adddenah', [MapController::class, 'create'])->name('adddenah')->middleware(RedirectIfNotAuthenticated::class);;
Route::post('/storedenah', [MapController::class, 'store'])->name('storedenah');
Route::delete('/denah/{id}', [MapController::class, 'destroy'])->name('deletedenah');


// Document
Route::get('/document', [DocumentController::class, 'index'])->name('Document')->middleware(RedirectIfNotAuthenticated::class);;

Route::get('/viewdocument', [DocumentController::class, 'index'])->name('viewdocument')->middleware(RedirectIfNotAuthenticated::class);
Route::get('/adddocument', [DocumentController::class, 'create'])->name('adddocument')->middleware(RedirectIfNotAuthenticated::class);;
Route::post('/storedocument', [DocumentController::class, 'store'])->name('storedocument');
Route::delete('/document/{id}', [DocumentController::class, 'destroy'])->name('deletedocument');

