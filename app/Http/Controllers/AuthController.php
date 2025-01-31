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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get user from database using Query Builder
        $user = DB::table('users')->where('email', $request->email)->firstOrFail();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            return redirect()->route('first');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    // public function logout()
    // {
    //     Auth::logout();
    //     Session::flush();

    //     // return redirect()->route('login.form');
    // }
}

