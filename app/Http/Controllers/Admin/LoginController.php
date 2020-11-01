<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StaffLoginRequest;
use App\Http\Services\StaffLoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $staffLoginService;

    public function __construct()
    {
        $this->staffLoginService = new StaffLoginService();
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
     * @param \App\Http\Requests\StaffLoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin(StaffLoginRequest $request)
    {
        return $this->staffLoginService->login($request);
    }

    /**
     * ログアウト処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('admin.login');
    }
}
