<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function customer()
    {

$customers= DB::table('customer')->get();

        return view('customer.customer',[
            "customers"=>$customers
        ]);

    }

    public function inputCustomer(Request $request)
    {

        $request->validate([
            'name'         => 'required|string|max:50',
            'address'      => 'required|string|max:50',
            'phone_number' => 'required|gt:0',

        ]);

        DB::table('customer')->insert([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('customer');

    }
}
