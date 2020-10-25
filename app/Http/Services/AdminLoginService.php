<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginService
{
    public function login(Request $request)
    {
        $authenticated = Auth::guard('admin')->attempt(
            $request->only(['email', 'password']), $request->has('remember')
        );
        if (! $authenticated) {
            return redirect()->route('admin.login')
                ->withInput($request->validated())
                ->withErrors(['email' => 'IDまたはパスワードが違います。']);
        }
        return redirect()->route('admin.home');
    }
}
