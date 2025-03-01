<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
abstract class Controller
{
    public function first(){

        // if (!Session::has('user_id')) {
        //     return redirect('/login');
        // }

        return view('first.first');


    }

   


}
