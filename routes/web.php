<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;



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

// Route::get('/', function () {
//     return view('welcomee');
// });

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'authlogin'])->name('admin.post.login');

Route::middleware(['auth'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('admin.delete.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    //Admin OBAT
    Route::get('/daftarobat', [AdminController::class, 'indexobat'])->name('admin.obat.index');
    Route::post('/tambahobat', [AdminController::class, 'storeobat'])->name('admin.obat.store');
    Route::post('/obat/{id}/update', [AdminController::class, 'updateobat'])->name('admin.obat.update');
    Route::delete('/obat/{id}', [AdminController::class, 'destroyobat'])->name('admin.obat.destroy');

    //admin TINDAKAN
    Route::get('/daftartindakan', [AdminController::class, 'indextindakan'])->name('admin.tindakan.index');
    Route::post('/tambahtindakan', [AdminController::class, 'storetindakan'])->name('admin.tindakan.store');
    Route::post('/tindakan/{id}/update', [AdminController::class, 'updatetindakan'])->name('admin.tindakan.update');
    Route::delete('/tindakan/{id}', [AdminController::class, 'destroytindakan'])->name('admin.tindakan.destroy');


    //admin USER
    Route::get('/daftaruser', [AdminController::class, 'indexuser'])->name('admin.user.index');
    Route::post('/tambahuser', [AdminController::class, 'storeuser'])->name('admin.user.store');
    Route::post('/user/{id}/update', [AdminController::class, 'updateuser'])->name('admin.user.update');
    Route::delete('/user/{id}', [AdminController::class, 'destroyuser'])->name('admin.user.destroy');

    //admin PEGAWAI
    Route::get('/daftarpegawai', [AdminController::class, 'indexpegawai'])->name('admin.pegawai.index');






    
    //dokter
    Route::get('/belumditangani', [DokterController::class, 'belum'])->name('admin.dokter.belum');
    Route::put('/belumditangani/show/{id}', [DokterController::class, 'show'])->name('admin.dokter.show');
    Route::put('/belumditangani/update/{id}', [DokterController::class, 'update'])->name('admin.dokter.update');
    Route::get('/sudahditangani', [DokterController::class, 'sudah'])->name('admin.dokter.sudah');



    //Kasir
    Route::get('/daftarpasien', [KasirController::class, 'index'])->name('admin.kasir.index');
    Route::post('/pembayaran/{id}/bayar', [KasirController::class, 'bayar'])->name('admin.kasir.bayar');

    Route::get('/daftarpasienlunas', [KasirController::class, 'indexlunas'])->name('admin.kasirlunas.index');
    Route::get('/kunjungan/{id}/cetak-pdf', [KasirController::class, 'cetakPdf'])->name('admin.kasir.cetak_pdf');



    

    

    //pendaftaran
    Route::get('/pendaftaranpasien', [PendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::post('/tambahpendaftaran', [PendaftaranController::class, 'store'])->name('admin.pendaftaran.store');
    

    
});
    



    




});


