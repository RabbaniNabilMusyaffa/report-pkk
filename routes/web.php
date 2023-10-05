<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TaskController;
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

// Main Page Route
Route::get('/', [LaporanController::class, 'index'])->name('home');
Route::get('/listProduk', [LaporanController::class, 'listProduk'])->name('list-produk');
Route::get('/tambahLaporan', [LaporanController::class, 'tambahLaporan'])->name('tambah-laporan');
Route::post('/tambahDataLaporan', [LaporanController::class, 'tambahDataLaporan'])->name('tambah-data-laporan');
Route::get('/editLaporan/{id}', [LaporanController::class, 'edit'])->name('Laporan-edit');
Route::post('/updateLaporan/{id}', [LaporanController::class, 'update'])->name('Laporan-update');
Route::delete('/delete/{id}', [LaporanController::class, 'Delete'])->name('delete');

