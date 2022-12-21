<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

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
    return redirect(route('login'));
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register/store', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('cart', CartController::class)->only(['index','store']);
    Route::get('cart/{prefix}/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::resource('transaction', TransactionController::class)->only(['index','store','show']);

    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('product', ProductController::class)->except(['edit']);
        Route::post('report/export', [ReportController::class, 'export'])->name('report.export');
        Route::resource('report', ReportController::class)->only(['index']);
        Route::resource('user', UserController::class)->only(['index']);
    });
});
