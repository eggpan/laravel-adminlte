<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffLoginService
{
    /**
     * ログイン処理の実行
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $authenticated = Auth::guard('staff')->attempt(
            $request->only(['email', 'password']), $request->has('remember')
        );
        if (! $authenticated) {
            return redirect()->route('admin.login')
                ->withInput($request->validated())
                ->withErrors(['email' => __('auth.failed')]);
        }
        return redirect()->route('admin.home');
    }
}
