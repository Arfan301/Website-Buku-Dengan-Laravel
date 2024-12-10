<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD Routes
Route::get('/main', [bukuController::class, 'index'])->name('bukus.index');
Route::get('/search', [bukuController::class, 'search'])->name('bukus.search');
Route::get('/buku/create', [bukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [bukuController::class, 'store'])->name('buku.store');
Route::get('/buku/{buku}/edit', [bukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{buku}', [bukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/{buku}', [bukuController::class, 'destroy'])->name('buku.destroy');
