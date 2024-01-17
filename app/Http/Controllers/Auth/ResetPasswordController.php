<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ResetPasswordController
{
    public function passwordreset(Request $request) {

        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:50', 'confirmed']
        ]);

        $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);//->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        dump($request);

        return $status === PASSWORD::PASSWORD_RESET
                //?   dump($status)
                //:   dump($status);
                ? redirect('/')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }
}