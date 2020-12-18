<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffUpdatePasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('admin.forgot-password');
    }

    public function sendEmail(Request $request)
    {
        $status = Password::broker('staff')->sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($encryptEmail, $token)
    {
        $email = Crypt::decryptString($encryptEmail);
        return view('admin.reset-password', [
            'email' => $email,
            'token' => $token,
        ]);
    }

    public function updatePassword(StaffUpdatePasswordRequest $request)
    {
        $status = Password::broker('staff')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));
                event(new PasswordReset($user));
            }
        );
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('message.success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
