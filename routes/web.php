<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\LaporanController;

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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Auth::routes();

Route::resource('data-outlet', OutletController::class);
Route::resource('data-paket', PaketController::class);
Route::resource('data-pelanggan', PelangganController::class);
Route::resource('data-pengguna', PenggunaController::class);
Route::resource('transaksi', TransaksiController::class);

Route::get('/json/{id}/cari-pelanggan', [TransaksiController::class, 'cariMember']);
Route::get('tambah-paket/{idTransaksi}/transaksi/{idOutlet}', [TransaksiController::class, 'tambahPaket'])->name('tambahPaket');

Route::get('/json/cari-paket/{id}/detail-transaksi', [TransaksiController::class, 'detailTransaksi'])->name('json.dTransaksi');
Route::get('/json/{id}/status', [TransaksiController::class, 'jsonStatus']);
Route::patch('/status/{id}/update', [TransaksiController::class, 'statusUpdate']);
Route::post('tambah-paket/{id}/detail-transaksi', [TransaksiController::class, 'paketStore'])->name('tPaketStore');
Route::delete('dPaket/{id}', [TransaksiController::class, 'destroyPaket'])->name('dPaket');
Route::post('update/transaksi/{id}/detail-transaksi',[TransaksiController::class, 'updateTransaksi'])->name('uTransaksi');
Route::get('/detail-transaksi/{kodeinvoice}/cucian', [TransaksiController::class, 'detailView']);

// Json Dynamic Dropdown
Route::get('json/cari-paket/{id}',[TransaksiController::class, 'paket']);
Route::get('json/cari-jenis/{id}/{namaPaket}',[TransaksiController::class, 'jenis']);
Route::get('json/cari-harga/{id}',[TransaksiController::class, 'harga']);

Route::get('/laporan', [LaporanController::class, 'index']);
Route::post('/getlaporan', [LaporanController::class, 'getTransaksi']);
Route::post('/laporan/export', [LaporanController::class, 'export']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
