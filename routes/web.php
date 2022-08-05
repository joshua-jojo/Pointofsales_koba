<?php

use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\InventoryTransaksiController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\PemasukkanController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CashierTransaksiController;
use App\Http\Controllers\CookController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WaitressController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect('/login');
});



// login 
Route::resource('/login', LoginController::class);

// register  
Route::get('/register', function () {
    return Inertia::render('Auth/register');
})->name('register');

// layouts 
Route::get('/blank', function () {
    return Inertia::render('Template/blank');
});


Route::group(['middleware' => ['admin']], function () {
    Route::resource('/beranda', BerandaController::class);
    Route::prefix('master')->name('master')->group(function () {
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/satuan', SatuanController::class);
        Route::resource('/produk', ProdukController::class);
        Route::resource('/meja', MejaController::class);
    });
    Route::prefix('transaksi')->name('transaksi')->group(function () {
        Route::resource('/pemasukkan', PemasukkanController::class);
        Route::resource('/pengeluaran', PengeluaranController::class);
    });
    Route::prefix('system')->name('system')->group(function () {
        Route::resource('/user', UserController::class);
        Route::resource('settings',SettingController::class);
    });
    Route::prefix('warehouse')->name('warehouse')->group(function () {
        Route::resource('inventory', InventoryController::class);
        Route::resource('inventorytransaksi', InventoryTransaksiController::class);
    });
});

Route::get('/bar', function () {
    return Inertia::render('Chart/bar');
})->name('bar');
Route::get('/tambah_pesanan/{id}', [GuestController::class,'tambah'])->name('tambahpesan');
Route::post('/update_pesanan/{id}', [GuestController::class,'update_pesanan'])->name('updatepesan');

Route::resource('waitress', WaitressController::class)->middleware('waitress');
Route::resource('cook', CookController::class)->middleware('cook');
Route::resource('barista', CookController::class)->middleware('barista');
Route::resource('cashier', CashierController::class)->middleware('cashier');
Route::resource('cashiertransaksi', CashierTransaksiController::class)->middleware('cashier');
Route::resource('pesan', GuestController::class);

