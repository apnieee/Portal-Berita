<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaPublicController;
use App\Http\Controllers\Auth\AuthController;

//halaman utama
Route::get('/', [BeritaPublicController::class, 'index'])->name('home');

//detail berita
Route::get('/berita/{berita}', [BeritaPublicController::class, 'show'])->name('berita.show');

//auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');