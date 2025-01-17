<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function buy(){

        return view('buy.buy');
    }
}
