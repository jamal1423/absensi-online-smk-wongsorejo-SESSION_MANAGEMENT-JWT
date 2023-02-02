<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SiswaController;
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


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login_admin')->name('login');
    Route::get('login', 'login_admin')->name('login');
    Route::post('login', 'authenticate_admin');
    Route::get('logout', 'logout');
    // Route::post('refresh', 'refresh');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'halaman_dashboard');
});

Route::controller(KelasController::class)->group(function () {
    Route::get('data-kelas', 'data_kelas');
    Route::post('data-kelas/add', 'data_kelas_add');
    Route::post('data-kelas/edit', 'data_kelas_edit');
    Route::delete('data-kelas/delete', 'data_kelas_delete');
    Route::get('get-data-kelas/{id}', 'get_data_kelas');
});

Route::controller(SiswaController::class)->group(function () {
    Route::get('data-siswa', 'data_siswa');
    Route::post('data-siswa/add', 'data_siswa_add');
    Route::post('data-siswa/edit', 'data_siswa_edit');
    Route::delete('data-siswa/delete', 'data_siswa_delete');
    Route::get('get-data-siswa/{id}', 'get_data_siswa');
});

Route::controller(LokasiController::class)->group(function () {
    Route::get('data-lokasi', 'data_lokasi');
    Route::post('data-lokasi/add', 'data_lokasi_add');
    Route::post('data-lokasi/edit', 'data_lokasi_edit');
    Route::delete('data-lokasi/delete', 'data_lokasi_delete');
    Route::get('get-data-lokasi/{id}', 'get_data_lokasi');
});

// Route::group(['middleware' => 'auth:web'], function () {
//     Route::get('/data-lokasi',[LokasiController::class, 'data_lokasi']);
// });
