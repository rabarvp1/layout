<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product()
    {
        $products = DB::table('product')
            ->join('cat', 'cat.id', 'product.cat_id')
            ->select(
                'product.*',
                'cat.name as category',
            )
            ->get();
            $cat=DB::table('cat')->get();

        return view('product.product', ['products' => $products ,'cat'=>$cat]);
    }

    public function upload(Request $request)
    {

        $request->validate([
            'name'   => 'required|string|max:50|unique:product,name',
            'price'  => 'required|numeric|gt:0',
            'stock'  => 'required|numeric|gt:0',
            'cat_id' => 'required|numeric',
        ]);

        DB::table('product')->insert([
            'name'   => $request->name,
            'price'  => $request->price,
            'stock'  => $request->stock,
            'cat_id' => $request->cat_id,
        ]);
        DB::table('cat')->select();

        return redirect('product');

    }
}
