<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('pasien/filter/{id_rumah_sakit?}', [PasienController::class,'filterByRumahSakit'])->name('pasien.filter');
    Route::get('pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    Route::get('rumah-sakit', [RumahSakitController::class, 'index'])->name('rumah-sakit.index');
    Route::get('rumah-sakit/create', [RumahSakitController::class, 'create'])->name('rumah-sakit.create');
    Route::post('rumah-sakit', [RumahSakitController::class, 'store'])->name('rumah-sakit.store');
    Route::get('rumah-sakit/{id}/edit', [RumahSakitController::class, 'edit'])->name('rumah-sakit.edit');
    Route::put('rumah-sakit/{id}', [RumahSakitController::class, 'update'])->name('rumah-sakit.update');
    Route::delete('rumah-sakit/{id}', [RumahSakitController::class, 'destroy'])->name('rumah-sakit.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


