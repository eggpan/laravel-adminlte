<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Services\AdminLoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->adminLoginService = new AdminLoginService();
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function doLogin(AdminLoginRequest $request)
    {
        return $this->adminLoginService->login($request);
    }

    public function doLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
