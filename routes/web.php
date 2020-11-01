<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
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
        Route::group(['middleware' => 'guest:admin'], function () {
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
            Route::post('login', [LoginController::class, 'doLogin'])->name('admin.login.post');
        });

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/', [HomeController::class, 'showDashboard'])->name('admin.home');
            Route::get('logout', [LoginController::class, 'doLogout'])->name('admin.logout');

            // 管理者メニュー
            Route::group(['middleware'=> 'permission:site.adminmenu.read'], function () {

                // BEGIN 管理者ユーザー
                Route::group(['middleware'=> 'permission:admin.read'], function () {
                    Route::get('admin', [AdminController::class, 'showList'])->name('admin.admin');
                    Route::get('admin/view/{id}', [AdminController::class, 'view'])->name('admin.admin.view');
                    Route::group(['middleware'=> 'permission:admin.create'], function () {
                        Route::get('admin/create', [AdminController::class, 'showCreateForm'])->name('admin.admin.create');
                        Route::post('admin/create', [AdminController::class, 'create'])->name('admin.admin.create.post');
                    });
                    Route::group(['middleware'=> 'permission:admin.update'], function () {
                        Route::get('admin/{id}', [AdminController::class, 'showEditForm'])->name('admin.admin.edit');
                        Route::put('admin/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit.put');
                    });
                    Route::group(['middleware'=> 'permission:admin.delete'], function () {
                        Route::delete('admin/{id}', [AdminController::class, 'delete'])->name('admin.admin.delete');
                        Route::get('admin/restore/{id}', [AdminController::class, 'restore'])->name('admin.admin.restore');
                    });
                });
                // END 管理者ユーザー
            });
        });
    });
}
