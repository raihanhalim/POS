<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokProdukController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\LaporanArusKasController;
use App\Http\Controllers\LaporanLabaKotorController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\SettingPenjualanController;
use App\Http\Controllers\LaporanProdukMasukController;
use App\Http\Controllers\LaporanProdukKeluarController;


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

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::group(['middleware'  => 'checkRole:admin,kasir,kepala toko'], function () {
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });

    Route::group(['middleware' => 'checkRole:admin,kasir'], function () {
        Route::get('/api/menu-penjualan', [PenjualanController::class, 'getAutoCompleteData']);
        Route::resource('/menu-penjualan', PenjualanController::class);
    });

    Route::group(['middleware' => 'checkRole:admin'], function () {

        Route::get('/produk/get-data', [ProdukController::class, 'getDataProduk']);
        Route::post('/produk/import', [ProdukController::class, 'import'])->name('produk.import');
        Route::resource('/produk', ProdukController::class);

        Route::get('/kategori/get-data', [KategoriController::class, 'getDataKategori']);
        Route::resource('/kategori', KategoriController::class);

        Route::get('/supplier/get-data', [SupplierController::class, 'getDataSupplier']);
        Route::resource('/supplier', SupplierController::class);

        Route::get('/satuan/get-data', [SatuanController::class, 'getDataSatuan']);
        Route::resource('/satuan', SatuanController::class);

        Route::get('/karyawan/get-data', [KaryawanController::class, 'getDataKaryawan']);
        Route::resource('/karyawan', KaryawanController::class);

        Route::get('/produk-masuk/get-data', [ProdukMasukController::class, 'getDataProdukMasuk']);
        Route::get('/api/produk-masuk', [ProdukMasukController::class, 'getAutoCompleteData']);
        Route::post('/produk-masuk/import', [ProdukMasukController::class, 'import'])->name('produkmasuk.import');
        Route::resource('/produk-masuk', ProdukMasukController::class);

        Route::get('/produk-keluar/get-data', [ProdukKeluarController::class, 'getDataProdukKeluar']);
        Route::get('/api/produk-keluar', [ProdukKeluarController::class, 'getAutoCompleteData']);
        Route::resource('/produk-keluar', ProdukKeluarController::class);
    });

    Route::group(['middleware'  => 'checkRole:admin,kepala toko'], function () {
        Route::get('/stok-produk/get-data', [StokProdukController::class, 'getDataStok']);
        Route::get('/stok-produk', [StokProdukController::class, 'index']);
        Route::get('/stok-produk/laporan-stok', [StokProdukController::class, 'printLaporanStok']);

        Route::get('/laporan-produk-masuk/get-data', [LaporanProdukMasukController::class, 'getLaporanProdukMasuk']);
        Route::get('/laporan-produk-masuk', [LaporanProdukMasukController::class, 'index']);
        Route::get('/laporan-produk-masuk/print-produk-masuk', [LaporanProdukMasukController::class, 'printLaporanProdukMasuk']);

        Route::get('/laporan-produk-keluar/get-data', [LaporanProdukKeluarController::class, 'getlaporanProdukKeluar']);
        Route::get('/laporan-produk-keluar', [LaporanProdukKeluarController::class, 'index']);
        Route::get('/laporan-produk-keluar/print-produk-keluar', [LaporanProdukKeluarController::class, 'printLaporanProdukKeluar']);

        Route::get('/laporan-penjualan/get-data', [LaporanPenjualanController::class, 'getDataPenjualan']);
        Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index']);
        Route::get('/laporan-penjualan/print-penjualan', [LaporanPenjualanController::class, 'printLaporanPenjualan']);

        Route::get('/laporan-arus-kas/get-data', [LaporanArusKasController::class, 'getDataArusKas']);
        Route::get('/laporan-arus-kas', [LaporanArusKasController::class, 'index']);
        Route::get('/laporan-arus-kas/print-arus-kas', [LaporanArusKasController::class, 'printLaporanArusKas']);

        Route::get('/laporan-laba-kotor/get-data', [LaporanLabaKotorController::class, 'getLaporanLabaKotor']);
        Route::get('/laporan-laba-kotor', [LaporanLabaKotorController::class, 'index']);
        Route::get('/laporan-laba-kotor/print-laba-kotor', [LaporanLabaKotorController::class, 'printLabaKotor']);

        Route::get('/setting-penjualan', [SettingPenjualanController::class, 'index']);
        Route::post('/setting-penjualan/update-diskon', [SettingPenjualanController::class, 'updateDiskon']);
        Route::post('/setting-penjualan/update-ppn', [SettingPenjualanController::class, 'updatePpn']);
    });
});
