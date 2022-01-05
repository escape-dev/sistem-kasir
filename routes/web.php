<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Kasir\DashboardController;
use App\Http\Controllers\Admin\DashboardController as DashboardAdminController;

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

// dashboard kasir
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route Penjualan
Route::get('/penjualan/send', [PenjualanController::class, 'create'])->middleware('auth')->name('penjualan.send');
Route::get('/penjualan/{penjualan}', [PenjualanController::class, 'penjualan'])->middleware('auth')->name('penjualan');
Route::post('/add-barang/penjualan', [PenjualanController::class, 'store'])->middleware('auth')->name('add-barang.penjualan');
Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->middleware('auth')->name('penjualan.update');
Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->middleware('auth')->name('penjualan.destroy');
Route::get('/simpan/penjualan/{penjualan}', [PenjualanController::class, 'simpan'])->middleware('auth')->name('simpan.penjualan');

//Route Pembelian
Route::get('/pemasok', [PembelianController::class, 'pemasok'])->middleware('auth')->name('pemasok.pemasok');
Route::post('/pemasok/send', [PembelianController::class, 'create'])->middleware('auth')->name('pemasok.send');
Route::get('/pembelian/{pembelian}', [PembelianController::class, 'pembelian'])->middleware('auth')->name('pembelian');
Route::post('/add-barang/pembelian', [PembelianController::class, 'store'])->middleware('auth')->name('add-barang.pembelian');
Route::put('/pembelian/{pembelian}', [PembelianController::class, 'update'])->middleware('auth')->name('pembelian.update');
Route::delete('/pembelian/{pembelian}', [PembelianController::class, 'destroy'])->middleware('auth')->name('pembelian.destroy');

// Resource Admin
Route::prefix('admins')
->middleware(['auth'])
->group(function() {

    // Resource Router
    Route::resource('kasir', KasirController::class)->middleware('auth');
    Route::resource('admin', AdminController::class)->middleware('auth');
    Route::resource('barang', BarangController::class)->middleware('auth');
    Route::resource('pemasok', PemasokController::class)->middleware('auth');

    // dashboard admin
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admins.dashboard');
    Route::get('/laporan/penjualan', [DashboardAdminController::class, 'data_penjualan'])->name('admins.laporan.penjualan');
    Route::get('/laporan/pembelian', [DashboardAdminController::class, 'data_pembelian'])->name('admins.laporan.pembelian');
});

require __DIR__.'/auth.php';
