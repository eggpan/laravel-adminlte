<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [LoginController::class, 'doLogin'])->name('admin.login.post');
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', [HomeController::class, 'showDashboard'])->name('admin.home');
        Route::get('logout', [LoginController::class, 'doLogout'])->name('admin.logout');
    });
});
