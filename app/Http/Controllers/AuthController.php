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
        return back()->with('error', __('auth.failed'));
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('user');

        return redirect()->route('login');
    }





    //-----------------Registration-----------------

    public function registration()
    {


       $users= DB::table('users')->get();

        return view('login.registration');

}

public function register(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);


    $user = DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    if ($user) {

        return redirect()->route('first')->with('success', 'Registration successful. Please login.');
    }

    return back()->with('error', 'Registration failed. Please try again.');
}



}
