<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Register Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles the registration of new users as well as their
   | validation and creation. By default this controller uses a trait to
   | provide this functionality without requiring any additional code.
   |
   */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'phoneNumber' => ['required', 'string', 'max:50', 'unique:users'],
            'address' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
            'terms' => ['accepted']
        ], [
            'terms.accepted' => 'Je moet akkoord zijn met de algemene voorwaarden om een account aan te kunnen maken.'
        ]);
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $formField = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phoneNumber' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            //Email custom error messages
            'email.required' => 'Email is verplicht',
            'email.email' => 'Vul een geldig email account in',
            'email.unique' => 'Er is al een account geregristreerd op deze email',
            //Password custom error messages
            'password.required' => 'Wachtwoord is verplicht',
            'password.min' => 'Het wachtwoord moet minimaal 8 karakters bevatten',
            'password.confirmed' => 'Het wachtwoord is anders dan bevestig wachtwoord'
        ]);

            // Hash the password
    $formField['password'] = bcrypt($formField['password']);

    $user = User::create($formField);

    // Authenticate the user
    auth()->login($user);

    return redirect('/');
    }
}
