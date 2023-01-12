<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::controller(MobilController::class)->group(function () {
        Route::get('/mobil', 'index');
        Route::get('/tambah-mobil', 'add');
        Route::post('/mobil/add', 'store');
        Route::get('/mobil/{id}', 'edit');
        Route::put('/mobil/{id}', 'update');
        Route::delete('/mobil/{mobil}', 'delete')->name('mobil.delete');
    });
    Route::controller(KriteriaController::class)->group(function() {
        Route::get('/kriteria', 'index')->name('kriteria.index');
        Route::get('/tambah-sub-kriteria', 'addSubKriteria')->name('sub-kriteria.add');
        Route::post('/kriteria/add', 'storeSubKriteria')->name('sub-kriteria.store');
        Route::get('/kriteria/{id}', 'editKriteria')->name('kriteria.edit');
        Route::put('/kriteria/{kriteria}', 'updateKriteria')->name('kriteria.update');
        Route::put('/sub-kriteria/{sub_kriteria}', 'updateSubKriteria')->name('sub-kriteria.update');
    });
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hasil-filter', [HomeController::class, 'hasilFilter'])->name('hasil-filter');
Route::post('/proses-spk', [HomeController::class, 'prosesSPK'])->name('proses-spk');
