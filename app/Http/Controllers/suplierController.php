<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class suplierController extends Controller
{
    public function suplier()
    {

        $supliers = DB::table('suplier')->get();

        return view('suplier.suplier', ["supliers" => $supliers]);

    }
    public function inputSuplier(Request $request)
    {

        $request->validate([
            'name'         => 'required|string|max:50',
            'address'      => 'required|string|max:50',
            'phone_number' => 'required|gt:0',

        ]);

        DB::table('suplier')->insert([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('suplier');

    }

}
