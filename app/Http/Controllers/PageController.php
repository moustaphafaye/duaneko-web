<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PageController extends Controller
{

    // use AuthenticatesUsers;

    // protected $redirectTo = RouteServiceProvider::DASHBOARD;
    
    public function index(): View
    {
        return view('pages.index');
    }

    public function login(): View
    {
        return view('pages.login');
    }

    public function loginUser(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        // return redirect('dashboard/home');
        
        if (Auth::attempt($credentials)) {
            // dd(Auth::user()->role);
            
            return redirect()->intended('dashboard/home')->with('success', 'Connecté!');
        }
        else {
            return redirect('login')->withErrors(['login' => 'Les informations de connexion ne sont pas valides']);
        
        }

        // return redirect('login')->with('errors', 'Les informations de connexion ne sont pas valides');
    }
}
