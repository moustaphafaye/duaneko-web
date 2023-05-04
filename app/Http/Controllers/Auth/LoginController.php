<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function index() {
        return view('auth.login');
    }

    public function auth(Request $request) {
    
        
       
        $credentials = $request->only('email', 'password');
       
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard/home')
            ->withSuccess('Connecté');
            dd('ok');
        }

        return redirect("login")->withSuccess('Les informations de connexion ne sont pas valides');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
