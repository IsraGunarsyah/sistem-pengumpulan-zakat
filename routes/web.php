<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UPZController;
use App\Http\Middleware\SessionTimeoutMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// admin route
Route::middleware(['auth', SessionTimeoutMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.index');
    Route::get('/admin/upz/create', [UPZController::class, 'create'])->name('admin.upz.create');
    Route::post('/admin/upz/store', [UPZController::class, 'store'])->name('admin.upz.store');
    Route::get('/admin/upz/{id}/edit', [UPZController::class, 'edit'])->name('admin.upz.edit');
    Route::put('/admin/upz/{id}', [UPZController::class, 'update'])->name('admin.upz.update');
    Route::delete('/admin/upz/{id}', [UPZController::class, 'destroy'])->name('admin.upz.destroy');
});


// Route untuk dashboard user
Route::middleware(['auth', SessionTimeoutMiddleware::class])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.index');
    Route::get('/user/map', [UserController::class, 'map'])->name('user.map-upz');
});
