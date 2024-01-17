<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wedding;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function index () {

        return view ('userManagement.index', [
            'weddings' => Wedding::all(),
            'users' => User::all(),
        ]);
    }
}
