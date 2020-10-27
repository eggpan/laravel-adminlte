<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Services\AdminLoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $adminLoginService;

    public function __construct()
    {
        $this->adminLoginService = new AdminLoginService();
    }

    /**
     * ログイン画面の表示
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * ログインボタン押下時の処理
     *
     * @param \App\Http\Requests\AdminLoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin(AdminLoginRequest $request)
    {
        return $this->adminLoginService->login($request);
    }

    /**
     * ログアウト処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
