<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WAController;
use App\Http\Controllers\DPTController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CagarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NomorController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\GabungController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\GantiPasswordController;

Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('daftar', [DaftarController::class, 'index']);
Route::get('gabung', [GabungController::class, 'index']);
Route::post('gabung', [GabungController::class, 'store']);
Route::get('masuk', [LoginController::class, 'masuk']);
Route::post('masuk', [LoginController::class, 'masukUser']);
Route::post('daftar', [DaftarController::class, 'daftar']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/gp', [GantiPasswordController::class, 'index']);
    Route::post('superadmin/gp', [GantiPasswordController::class, 'update']);
    Route::post('superadmin/sk/updatelurah', [HomeController::class, 'updatelurah']);

    Route::get('superadmin/petugas', [PetugasController::class, 'index']);
    Route::get('superadmin/petugas/create', [PetugasController::class, 'create']);
    Route::post('superadmin/petugas/create', [PetugasController::class, 'store']);
    Route::get('superadmin/petugas/cari', [PetugasController::class, 'cari']);
    Route::get('superadmin/petugas/delete/{id}', [PetugasController::class, 'delete']);
    Route::get('superadmin/petugas/edit/{id}', [PetugasController::class, 'edit']);
    Route::post('superadmin/petugas/edit/{id}', [PetugasController::class, 'update']);

    Route::get('superadmin/kategori', [KategoriController::class, 'index']);
    Route::get('superadmin/kategori/create', [KategoriController::class, 'create']);
    Route::post('superadmin/kategori/create', [KategoriController::class, 'store']);
    Route::get('superadmin/kategori/cari', [KategoriController::class, 'cari']);
    Route::get('superadmin/kategori/delete/{id}', [KategoriController::class, 'delete']);
    Route::get('superadmin/kategori/edit/{id}', [KategoriController::class, 'edit']);
    Route::post('superadmin/kategori/edit/{id}', [KategoriController::class, 'update']);

    Route::get('superadmin/jadwal', [JadwalController::class, 'index']);
    Route::get('superadmin/jadwal/create', [JadwalController::class, 'create']);
    Route::post('superadmin/jadwal/create', [JadwalController::class, 'store']);
    Route::get('superadmin/jadwal/cari', [JadwalController::class, 'cari']);
    Route::get('superadmin/jadwal/delete/{id}', [JadwalController::class, 'delete']);
    Route::get('superadmin/jadwal/edit/{id}', [JadwalController::class, 'edit']);
    Route::post('superadmin/jadwal/edit/{id}', [JadwalController::class, 'update']);

    Route::get('superadmin/cagar', [CagarController::class, 'index']);
    Route::get('superadmin/cagar/create', [CagarController::class, 'create']);
    Route::post('superadmin/cagar/create', [CagarController::class, 'store']);
    Route::get('superadmin/cagar/cari', [CagarController::class, 'cari']);
    Route::get('superadmin/cagar/delete/{id}', [CagarController::class, 'delete']);
    Route::get('superadmin/cagar/edit/{id}', [CagarController::class, 'edit']);
    Route::post('superadmin/cagar/edit/{id}', [CagarController::class, 'update']);

    Route::get('superadmin/user', [AdminController::class, 'user']);
    Route::get('superadmin/user/create', [AdminController::class, 'user_create']);
    Route::post('superadmin/user/create', [AdminController::class, 'user_store']);
    Route::get('superadmin/user/edit/{id}', [AdminController::class, 'user_edit']);
    Route::post('superadmin/user/edit/{id}', [AdminController::class, 'user_update']);
    Route::get('superadmin/user/delete/{id}', [AdminController::class, 'user_delete']);

    Route::get('superadmin/absensi', [AdminController::class, 'absensi']);
    Route::get('superadmin/absensi/create', [AdminController::class, 'absensi_create']);
    Route::post('superadmin/absensi/create', [AdminController::class, 'absensi_store']);
    Route::get('superadmin/absensi/edit/{id}', [AdminController::class, 'absensi_edit']);
    Route::post('superadmin/absensi/edit/{id}', [AdminController::class, 'absensi_update']);
    Route::get('superadmin/absensi/delete/{id}', [AdminController::class, 'absensi_delete']);

    Route::get('superadmin/kelurahan', [AdminController::class, 'kelurahan']);
    Route::get('superadmin/kelurahan/create', [AdminController::class, 'kelurahan_create']);
    Route::post('superadmin/kelurahan/create', [AdminController::class, 'kelurahan_store']);
    Route::get('superadmin/kelurahan/edit/{id}', [AdminController::class, 'kelurahan_edit']);
    Route::post('superadmin/kelurahan/edit/{id}', [AdminController::class, 'kelurahan_update']);
    Route::get('superadmin/kelurahan/delete/{id}', [AdminController::class, 'kelurahan_delete']);


    Route::get('superadmin/laporan', [AdminController::class, 'laporan']);
    Route::get('superadmin/laporan/absensi', [AdminController::class, 'laporan_absensi']);
    Route::get('superadmin/laporan/jadwal', [AdminController::class, 'laporan_jadwal']);
    Route::get('superadmin/laporan/cagar', [AdminController::class, 'laporan_cagar']);
    Route::get('superadmin/laporan/hasil', [AdminController::class, 'laporan_hasil']);
    Route::get('superadmin/laporan/pengunjung', [AdminController::class, 'laporan_pengunjung']);
    Route::get('laporan/print', [AdminController::class, 'print']);
    Route::get('laporan/print2', [AdminController::class, 'print2']);
});

Route::group(['middleware' => ['auth', 'role:user']], function () {

    Route::get('user', [HomeController::class, 'user']);
    Route::get('user/laporan/monitoring/{id}', [UserController::class, 'hasil']);
    Route::post('user/laporan/monitoring/{id}', [UserController::class, 'hasilStore']);
    Route::get('user/sm/create', [UserController::class, 'sm_create']);
    Route::post('user/sm/create', [UserController::class, 'sm_store']);
    Route::get('user/sm/edit/{id}', [UserController::class, 'sm_edit']);
    Route::post('user/sm/edit/{id}', [UserController::class, 'sm_update']);
    Route::get('user/sm/delete/{id}', [UserController::class, 'sm_delete']);
});
