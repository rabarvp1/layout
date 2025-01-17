<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catController extends Controller
{
    public function cat()
    {
        $cat = DB::table('cat')->get();

        return view('cat.cat', ["cat" => $cat]);
    }

    public function inputCat(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:50|unique:product,name']);

        DB::table('cat')->insert([
            'name' => $request->name]);

        return redirect('cat');

    }
}
