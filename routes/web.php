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

    Route::get('superadmin/kecamatan', [AdminController::class, 'kecamatan']);
    Route::get('superadmin/kecamatan/create', [AdminController::class, 'kecamatan_create']);
    Route::post('superadmin/kecamatan/create', [AdminController::class, 'kecamatan_store']);
    Route::get('superadmin/kecamatan/edit/{id}', [AdminController::class, 'kecamatan_edit']);
    Route::post('superadmin/kecamatan/edit/{id}', [AdminController::class, 'kecamatan_update']);
    Route::get('superadmin/kecamatan/delete/{id}', [AdminController::class, 'kecamatan_delete']);

    Route::get('superadmin/kelurahan', [AdminController::class, 'kelurahan']);
    Route::get('superadmin/kelurahan/create', [AdminController::class, 'kelurahan_create']);
    Route::post('superadmin/kelurahan/create', [AdminController::class, 'kelurahan_store']);
    Route::get('superadmin/kelurahan/edit/{id}', [AdminController::class, 'kelurahan_edit']);
    Route::post('superadmin/kelurahan/edit/{id}', [AdminController::class, 'kelurahan_update']);
    Route::get('superadmin/kelurahan/delete/{id}', [AdminController::class, 'kelurahan_delete']);

    Route::get('superadmin/rt', [AdminController::class, 'rt']);
    Route::get('superadmin/rt/create', [AdminController::class, 'rt_create']);
    Route::post('superadmin/rt/create', [AdminController::class, 'rt_store']);
    Route::get('superadmin/rt/edit/{id}', [AdminController::class, 'rt_edit']);
    Route::post('superadmin/rt/edit/{id}', [AdminController::class, 'rt_update']);
    Route::get('superadmin/rt/delete/{id}', [AdminController::class, 'rt_delete']);

    Route::get('superadmin/sm', [AdminController::class, 'sm']);
    Route::get('superadmin/sm/create', [AdminController::class, 'sm_create']);
    Route::post('superadmin/sm/create', [AdminController::class, 'sm_store']);
    Route::get('superadmin/sm/edit/{id}', [AdminController::class, 'sm_edit']);
    Route::post('superadmin/sm/edit/{id}', [AdminController::class, 'sm_update']);
    Route::get('superadmin/sm/delete/{id}', [AdminController::class, 'sm_delete']);

    Route::get('superadmin/surat', [AdminController::class, 'surat']);
    Route::get('superadmin/surat/create', [AdminController::class, 'surat_create']);
    Route::post('superadmin/surat/create', [AdminController::class, 'surat_store']);
    Route::get('superadmin/surat/edit/{id}', [AdminController::class, 'surat_edit']);
    Route::post('superadmin/surat/edit/{id}', [AdminController::class, 'surat_update']);
    Route::get('superadmin/surat/delete/{id}', [AdminController::class, 'surat_delete']);

    Route::get('superadmin/pemeriksaan', [AdminController::class, 'pemeriksaan']);
    Route::get('superadmin/pemeriksaan/create', [AdminController::class, 'pemeriksaan_create']);
    Route::get('superadmin/pemeriksaan/periksa/{id}', [AdminController::class, 'pemeriksaan_create2']);
    Route::post('superadmin/pemeriksaan/create2', [AdminController::class, 'pemeriksaan_store']);
    Route::get('superadmin/pemeriksaan/edit/{id}', [AdminController::class, 'pemeriksaan_edit']);
    Route::post('superadmin/pemeriksaan/edit/{id}', [AdminController::class, 'pemeriksaan_update']);
    Route::get('superadmin/pemeriksaan/delete/{id}', [AdminController::class, 'pemeriksaan_delete']);
    Route::get('superadmin/pemeriksaan/cetak/{id}', [AdminController::class, 'pemeriksaan_cetak']);

    Route::get('superadmin/registrasi', [AdminController::class, 'registrasi']);
    Route::get('superadmin/registrasi/create', [AdminController::class, 'registrasi_create']);
    Route::post('superadmin/registrasi/create', [AdminController::class, 'registrasi_store']);
    Route::get('superadmin/registrasi/edit/{id}', [AdminController::class, 'registrasi_edit']);
    Route::post('superadmin/registrasi/edit/{id}', [AdminController::class, 'registrasi_update']);
    Route::get('superadmin/registrasi/delete/{id}', [AdminController::class, 'registrasi_delete']);

    Route::get('superadmin/koordinatortps', [AdminController::class, 'koordinatortps']);
    Route::get('superadmin/koordinatortps/create', [AdminController::class, 'koordinatortps_create']);
    Route::post('superadmin/koordinatortps/create', [AdminController::class, 'koordinatortps_store']);
    Route::get('superadmin/koordinatortps/edit/{id}', [AdminController::class, 'koordinatortps_edit']);
    Route::post('superadmin/koordinatortps/edit/{id}', [AdminController::class, 'koordinatortps_update']);
    Route::get('superadmin/koordinatortps/delete/{id}', [AdminController::class, 'koordinatortps_delete']);


    Route::get('superadmin/ketuart', [AdminController::class, 'rt']);
    Route::get('superadmin/ketuart/create', [AdminController::class, 'rt_create']);
    Route::post('superadmin/ketuart/create', [AdminController::class, 'rt_store']);
    Route::get('superadmin/ketuart/edit/{id}', [AdminController::class, 'rt_edit']);
    Route::post('superadmin/ketuart/edit/{id}', [AdminController::class, 'rt_update']);
    Route::get('superadmin/ketuart/delete/{id}', [AdminController::class, 'rt_delete']);

    Route::get('superadmin/timses/grup', [GrupController::class, 'index']);
    Route::get('superadmin/timses/grup/create', [GrupController::class, 'create']);
    Route::post('superadmin/timses/grup/create', [GrupController::class, 'store']);
    Route::get('superadmin/timses/grup/edit/{id}', [GrupController::class, 'edit']);
    Route::post('superadmin/timses/grup/edit/{id}', [GrupController::class, 'update']);
    Route::get('superadmin/timses/grup/delete/{id}', [GrupController::class, 'delete']);

    Route::get('superadmin/laporan', [AdminController::class, 'laporan']);
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
