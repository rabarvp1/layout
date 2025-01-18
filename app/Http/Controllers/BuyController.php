<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyController extends Controller
{
    public function buy()
    {
        $products = DB::table('product')->get();

        $storages = DB::table('storage')
            ->join('product', 'storage.product_id', 'product.id')
            ->select(
                'storage.*',
                'product.name as product_name',
            )
            ->get();
        return view('buy.buy', ['products' => $products, 'storages' => $storages]);
    }
    public function insert(Request $request)
    {
       
        $product = DB::table('product')->where('id', $request->product_id)->first();
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|gt:0',

        ]);

        // |exists:product,cat_id

        DB::table('storage')->insert([
            'product_id'      => $request->product_id,
            'quantity'        => $request->quantity,
            'purchease_price' => $product->price,

        ]);
        return redirect('buy');

    }
}
