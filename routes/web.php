<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\NarudzbinaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CheckUserLoggedIn;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(CheckUserLoggedIn::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('storeLogin');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('storeRegister');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/not-auth', [AuthController::class, 'notAuth'])->name('not-auth');

Route::get('/', [ProizvodController::class, 'istaknuti'])->name('pocetna');
Route::get('/katalog', [ProizvodController::class, 'index'])->name('katalog');
Route::get('/proizvodi/{proizvod}', [ProizvodController::class, 'show'])->name('proizvod.prikazi');
Route::get('/kontakt', function () {
    return view('kontakt');
})->name('kontakt');

Route::middleware(AuthMiddleware::class)->group(function () {

    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [UserController::class, 'update'])->name('profile.update');

    Route::get('/narudzbine', [NarudzbinaController::class, 'index'])->name('narudzbine.index');
    Route::get('/narudzbine/create', [NarudzbinaController::class, 'create'])->name('narudzbine.create');
    Route::post('/narudzbine', [NarudzbinaController::class, 'store'])->name('narudzbine.store');
    Route::get('/narudzbine/{id}/edit', [NarudzbinaController::class, 'edit'])->name('narudzbine.edit');
    Route::put('/narudzbine/{id}', [NarudzbinaController::class, 'update'])->name('narudzbine.update');
    Route::delete('/narudzbine/{id}/delete', [NarudzbinaController::class, 'destroy'])->name('narudzbine.destroy');


    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::get('/proizvodi', [ProizvodController::class, 'adminIndex'])->name('admin.proizvodi');
        Route::get('/proizvodi/create', [ProizvodController::class, 'create'])->name('proizvod.create');
        Route::post('/proizvodi', [ProizvodController::class, 'store'])->name('proizvod.store');
        Route::get('/proizvodi/{id}/edit', [ProizvodController::class, 'edit'])->name('proizvod.edit');
        Route::put('/proizvodi/{id}', [ProizvodController::class, 'update'])->name('proizvodi.update');
        Route::delete('/proizvodi/{id}', [ProizvodController::class, 'destroy'])->name('proizvod.obrisi');

        Route::get('/narudzbine', [NarudzbinaController::class, 'adminIndex'])->name('admin.narudzbine');
        Route::get('narudzbine/{id}/izmeni', [NarudzbinaController::class, 'izmeni'])->name('narudzbine.izmeni');
        Route::get('/narudzbine/dodaj', [NarudzbinaController::class, 'dodaj'])->name('narudzbine.dodaj');
        Route::post('/narudzbine', [NarudzbinaController::class, 'dodato'])->name('narudzbine.dodato');
        Route::delete('/narudzbine/{id}', [NarudzbinaController::class, 'obrisi'])->name('narudzbine.obrisi');
        Route::put('/narudzbina/{id}', [NarudzbinaController::class, 'azuriraj'])->name('narudzbina.azuriraj');
        
        Route::get('/korisnici', [KorisnikController::class, 'index'])->name('admin.korisnici');
        Route::get('/korisnici/create', [KorisnikController::class, 'create'])->name('korisnici.create');
        Route::post('/korisnici', [KorisnikController::class, 'store'])->name('korisnici.store');
        Route::get('/korisnici/{id}/edit', [KorisnikController::class, 'edit'])->name('korisnici.edit');
        Route::put('/korisnici/{id}', [KorisnikController::class, 'update'])->name('korisnici.update');
        Route::delete('/korisnici/{id}', [KorisnikController::class, 'obrisi'])->name('korisnici.obrisi');

    });
});

