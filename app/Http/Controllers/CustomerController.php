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
            'phone_number' => 'required|gt:0|unique:customer,phone_number',

        ]);

        DB::table('customer')->insert([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('customer');

    }

    public function edit_customer($id){

        $customer = DB::table('customer')->where('id', $id)->firstOrFail();



        return view('customer.edit' , compact('customer'));

    }
    public function update_customer(Request $request,$id){

        $request->validate([
            'name'         => 'required|string|max:50',
            'address'      => 'required|string|max:50',

        ]);

        DB::table('customer')->where('id', $id)->update([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('customer')->with('success', 'Product updated successfully!');




    }

    public function delete_customer($id){

          DB::table('customer')->where('id', $id)->delete();

          return redirect('customer')->with('success', 'customer deleted successfully!');
    }
}
