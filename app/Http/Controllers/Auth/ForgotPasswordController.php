<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function passwordrequest (Request $request) {

        $this->middleware('throttle:600,1');

        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        dump($request->all());

        $status === Password::RESET_LINK_SENT
                //? dump($status)
                //: dump($status);
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }
}