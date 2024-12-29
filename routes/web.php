<?php

use App\Http\Controllers\MareController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', function () {
    return view('home');
});


//  Comme l'affichage de la liste des mares est public, on le sort de controle d'identification
Route::get('/', [MareController::class, 'index']);
Route::get('/mares/{mare}', [MareController::class, 'show']);

Route::get('/mares', function () {
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    // Toutes les routes pour mares necessitent une authentification, sauf l'index et shown
    Route::resource('mares', MareController::class)->except(['index','show']);
});




// Creation d'un compte
Route::get('/register', [RegisteredUserController::class,'create']);
// Utilisation d'un middleware antispam simple : ajout de champ honneypot dans le formulaire (voir la view qui contient @honeypot
Route::post('/register', [RegisteredUserController::class,'store'])->middleware(ProtectAgainstSpam::class);

// Connexion
Route::get('/login', [SessionController::class,'create'])->name('login'); // Named 'login' because middleware auth need it like that
Route::post('/login', [SessionController::class,'store']);

//Deconnexion
Route::post('/logout', [SessionController::class,'destroy']);
