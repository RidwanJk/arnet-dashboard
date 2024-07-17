<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\surat;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Controllers\STOController;




Route::get('/', function () {
    return redirect('/login');
});

//Auth
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/signin', [UserController::class, 'signin'])->name('signin');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/signup', [UserController::class, 'signup'])->name('signup');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Map
Route::get('/viewdenah', [MapController::class, 'index'])->name('viewdenah')->middleware(RedirectIfNotAuthenticated::class);
Route::resource('denah', MapController::class)->middleware(RedirectIfNotAuthenticated::class);
Route::get('/adddenah', [MapController::class, 'create'])->name('adddenah')->middleware(RedirectIfNotAuthenticated::class);
Route::post('/storedenah', [MapController::class, 'store'])->name('storedenah');
Route::delete('/denah/{id}', [MapController::class, 'destroy'])->name('deletedenah');


// Document
Route::get('/document', [DocumentController::class, 'index'])->name('Document')->middleware(RedirectIfNotAuthenticated::class);
Route::resource('document', DocumentController::class)->middleware(RedirectIfNotAuthenticated::class);
Route::get('/viewdocument', [DocumentController::class, 'index'])->name('viewdocument')->middleware(RedirectIfNotAuthenticated::class);
Route::get('/adddocument', [DocumentController::class, 'create'])->name('adddocument')->middleware(RedirectIfNotAuthenticated::class);
Route::post('/storedocument', [DocumentController::class, 'store'])->name('storedocument');
Route::get('/document/show/{id}', [DocumentController::class, 'show']);
Route::delete('/document/{id}', [DocumentController::class, 'destroy'])->name('deletedocument');
Route::get('/document/{id}/edit', [DocumentController::class, 'edit'])->name('document.edit')->middleware(RedirectIfNotAuthenticated::class);
Route::put('/document/{id}', [DocumentController::class, 'update'])->name('document.update');


//STO
Route::get('/sto', [STOController::class, 'index'])->name('sto')->middleware(RedirectIfNotAuthenticated::class);
Route::resource('sto', STOController::class)->middleware(RedirectIfNotAuthenticated::class);
Route::get('/viewsto', [STOController::class, 'index'])->name('viewsto')->middleware(RedirectIfNotAuthenticated::class);
Route::get('/addsto', [STOController::class, 'create'])->name('addsto')->middleware(RedirectIfNotAuthenticated::class);
Route::post('/storesto', [STOController::class, 'store'])->name('storesto');