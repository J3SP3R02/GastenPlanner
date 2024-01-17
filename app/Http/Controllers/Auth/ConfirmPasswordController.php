<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;

class ConfirmPasswordController
{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }
}
