<?php

use App\Http\Controllers\MareController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/mares', [MareController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::resource('mares', MareController::class)->except(['index']);
});


Route::get('/register', [RegisteredUserController::class,'create']);
Route::post('/register', [RegisteredUserController::class,'store']);


Route::get('/login', [SessionController::class,'create'])->name('login'); // Named because middleware auth need it;
Route::post('/login', [SessionController::class,'store']);

Route::post('/logout', [SessionController::class,'destroy']);
