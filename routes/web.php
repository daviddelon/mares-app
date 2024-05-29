<?php

use App\Http\Controllers\MareController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

//Route::resource(('mares'), MareController::class);


Route::get('/mares', [MareController::class, 'index']);
Route::get('/mares/create', [MareController::class,'create'])
    ->middleware('auth');
Route::get('/mares/{mare}', [MareController::class,'show']);

Route::post('/mares',[MareController::class, 'store'])
    ->middleware('auth');

Route::get('/mares/{mare}/edit',[MareController::class, 'edit'])
    ->middleware('auth');

Route::patch('/mares/{mare}',[MareController::class, 'update'])
    ->middleware('auth');

Route::delete('/mares/{mare}',[MareController::class, 'destroy'])
    ->middleware('auth');


Route::get('/register', [RegisteredUserController::class,'create']);
Route::post('/register', [RegisteredUserController::class,'store']);


Route::get('/login', [SessionController::class,'create'])->name('login'); // Named because middleware auth need it;
Route::post('/login', [SessionController::class,'store']);

Route::post('/logout', [SessionController::class,'destroy']);
