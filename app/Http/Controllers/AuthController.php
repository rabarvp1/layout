<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials=$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('first');

        }


        return back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('login');
    }
}

