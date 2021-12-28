<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/Account/Login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function registerView()
    {
        return view('register');
    }

    public function addUser(Request $request)
    {
        if (!$request->consent_to_the_processing_of_personal_data)
        {
            return redirect('/Account/Login');
        }

        $this->validate($request, [
            'email' => 'required|string|email|max:100|unique:users',
            'second_name' => 'string|max:50',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'string|max:50',
            'password' => 'required|string|min:4|max:255|confirmed',
        ]);

        User::create([
            'email' => $request->email,
            'user_role_id' => 3,     // Роль "пользователь"
            'second_name' => $request->second_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'password' => Hash::make($request->password),
            'consent_to_the_processing_of_personal_data' => TRUE,
        ]);

        return redirect('/Account/Login');
    }
}
