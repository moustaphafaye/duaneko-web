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
        if (Auth::attempt($credentials)) {
            $id = Auth::user()->id;
            $role = Auth::user()->role;
            $roles = $role;
            // dd($roles);
            if($roles =='admin_agent'){

                $afficherole = 'admin_agent';
                // dd($afficherole);
                return view('dashboard.index', ['role'=>$role, 'roles'=> $afficherole]);

                
            }
        return view('dashboard.index', ['role'=>$role ]);

            // return redirect()->intended('dashboard/home')->with('success', 'Connecté!');
        }
        elseif((empty($request->email)) || (empty($request->password)) ){
            // dd('ok');
            $request->validate([
                'email'=>'required|min:3',
                'password'=>'required|min:3'
            ]);
            return redirect()->back();
        }
        else  {
            return redirect('login')->withErrors(['login' => 'Les informations de connexion ne sont pas valides']);
        
        }

        // return redirect('login')->with('errors', 'Les informations de connexion ne sont pas valides');
    }
}
