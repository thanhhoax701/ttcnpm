<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\testController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\CSHTController;
use App\Http\Controllers\HopDongController;
use App\Http\Controllers\TramController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\TimkiemController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PhuLucController;

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
//router login
Route::get('/login', [LoginController::class, 'getLogin'])->name('login');;
Route::post('/login', [LoginController::class, 'postLogin'])->name('post-login');
Route::any('/forgotpassword', [LoginController::class, 'forgotpassword'])->name('forgot-password');

//check user auth login
Route::group(['middleware' => 'auth'], function () {
    // router home 
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LogoutController::class, 'getLogout'])->name('logout');

    // tai khoan 
    Route::get('/taikhoan', [TaiKhoanController::class, 'index'])->name('taikhoan');
    Route::get('/taikhoan/them', [TaiKhoanController::class, 'them'])->name('taikhoan-them');
    Route::post('/taikhoan/them', [TaiKhoanController::class, 'store'])->name('taikhoan-store');
    Route::get('/taikhoan/hienthi/{id}', [TaiKhoanController::class, 'hienthi'])->name('taikhoan-hienthi');
    Route::any('/taikhoan/chinhsua/{id}', [TaiKhoanController::class, 'chinhsua'])->name('taikhoan-chinhsua');
    Route::get('/taikhoan/xoa/{id}', [TaiKhoanController::class, 'xoa'])->name('taikhoan-xoa');
});
