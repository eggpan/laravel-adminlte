<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [HomeController::class, 'showDashboard'])->name('admin.home');
});
