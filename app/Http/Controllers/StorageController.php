<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{
    public function storage()
    {
        // $storage=DB::table('storage')->get();

        // $sell_product = DB::table('sell_product')->where('invoice_id', $id)
        // ->join('product', 'sell_product.product_id', 'product.id')
        // ->select('sell_product.*', 'product.name as product_name')
        // ->get();

        $storage = DB::table('storage')
            ->Join('product', 'product.id', '=', 'storage.product_id')
            ->Join('cat', 'cat.id', '=', 'product.cat_id')
            ->select('storage.*', 'product.name as product_name', 'cat.name as cat_name'
            )->get();

        return view('storage.storage', compact('storage'));
    }

    

}
