<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    public function sell()
    {
        $products=DB::table('product')->get();
        $sells = DB::table('sell')
        ->join('product','sell.product_id','product.id')
        ->select('sell.*','product.name as product_name')

        ->get();

        return view('sell.sell', ['sells' => $sells,'products'=>$products]);
    }
    public function insert_sell(Request $request)
    {

        $product=DB::table('storage')->where('product_id',$request->product_id)->first();
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|gt:0',
            'sell_price' => 'required|numeric|gt:0',

        ]);

        $total = $request->quantity * $request->sell_price;
        DB::table('sell')->insert([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'sell_price' => $request->sell_price,
            'total'      => $total,

        ]);

        DB::table('storage')->where('product_id',$request->product_id)->update(['quantity'=>$product->quantity-$request->quantity]);

        return redirect('sell');

    }
}
