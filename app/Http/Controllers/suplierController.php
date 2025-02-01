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

    public function edit_suplier($id)
    {

        $suplier = DB::table('suplier')->where('id', $id)->firstOrFail();

        return view('suplier.edit', compact('suplier'));

    }
    public function update_suplier(Request $request, $id)
    {

        $request->validate([
            'name'    => 'required|string|max:50',
            'address' => 'required|string|max:50',

        ]);

        DB::table('suplier')->where('id', $id)->update([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('suplier')->with('success', 'suplier updated successfully!');

    }

    public function delete_suplier($id)
    {

        DB::table('suplier')->where('id', $id)->delete();

        return redirect('customer')->with('success', 'suplier deleted successfully!');
    }

}
