<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LoginSource;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except($this->logoutUser());
    }

    public function loginView()
    {
        return view('login');
    }

    public function authUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials))
        {
            $nowTms = new \DateTime();
            $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

            $userAgent = 'site';

            if (strripos($request->userAgent(), 'iPhone') != FALSE)
            {
                $userAgent = 'iphone';
            }
            else if (strripos($request->userAgent(), 'android') != FALSE)
            {
                $userAgent = 'android';
            }

            LoginSource::create([
                'user_id' => Auth::id(),
                'tms' => $nowTmsFormat,
                'source' => $userAgent,
            ]);

            return redirect()->intended('/');
        }

        return redirect('/Account/Login')->with('error', 'Opps!');
    }

    public function logoutUser()
    {
        Auth::logout();

        return redirect('/');
    }
}
