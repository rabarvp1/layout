<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class product extends Controller

{
   public  function product() {
        return view('product.product');
    }
}
