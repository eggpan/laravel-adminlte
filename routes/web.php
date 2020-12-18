<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
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

if (config('site.enable_front')) {
    Route::get('/', function () {
        return view('welcome');
    });
}

if (config('site.enable_admin')) {
    Route::group(['prefix' => config('site.admin_prefix'), 'middleware' => 'set.locale'], function () {
        Route::group(['middleware' => 'guest:staff'], function () {
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
            Route::post('login', [LoginController::class, 'doLogin'])->name('admin.login.post');
            Route::get('forgot-password', [ResetPasswordController::class, 'showRequestForm'])->name('admin.password.request');
            Route::post('forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('admin.password.email');
            Route::get('reset-password/{encryptEmail}/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
            Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('admin.password.update');
        });

        Route::group(['middleware' => 'auth:staff'], function () {
            Route::get('/', [HomeController::class, 'showDashboard'])->name('admin.home');
            Route::get('logout', [LoginController::class, 'doLogout'])->name('admin.logout');

            // 管理者メニュー
            Route::group(['middleware'=> 'permission:site.adminmenu.read'], function () {

                // BEGIN 管理者スタッフ
                Route::group(['middleware'=> 'permission:staff.read'], function () {
                    Route::get('staff', [StaffController::class, 'showList'])->name('admin.staff');
                    Route::get('staff/view/{id}', [StaffController::class, 'view'])->name('admin.staff.view');
                    Route::group(['middleware'=> 'permission:staff.create'], function () {
                        Route::get('staff/create', [StaffController::class, 'showCreateForm'])->name('admin.staff.create');
                        Route::post('staff/create', [StaffController::class, 'create'])->name('admin.staff.create.post');
                    });
                    Route::group(['middleware'=> 'permission:staff.update'], function () {
                        Route::get('staff/{id}', [StaffController::class, 'showEditForm'])->name('admin.staff.edit');
                        Route::put('staff/{id}', [StaffController::class, 'edit'])->name('admin.staff.edit.put');
                    });
                    Route::group(['middleware'=> 'permission:staff.delete'], function () {
                        Route::delete('staff/{id}', [StaffController::class, 'delete'])->name('admin.staff.delete');
                        Route::get('staff/restore/{id}', [StaffController::class, 'restore'])->name('admin.staff.restore');
                    });
                });
                // END 管理者スタッフ

                Route::group(['middleware'=> 'permission:permission.read'], function () {
                    Route::get('role', [RoleController::class, 'showList'])->name('admin.role');
                    Route::get('role/view/{id}', [RoleController::class, 'view'])->name('admin.role.view');
                });
                Route::group(['middleware'=> 'permission:permission.update'], function () {
                    Route::get('role/{id}', [RoleController::class, 'showEditForm'])->name('admin.role.edit');
                    Route::put('role/{id}', [RoleController::class, 'edit'])->name('admin.role.edit.put');
                });
            });
        });
    });
}
