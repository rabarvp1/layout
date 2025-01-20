<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    public function sell()
    {
        $products = DB::table('product')->get();
        $invoices = DB::table('invoice')->get();
        $sells    = DB::table('invoice_id')
            ->join('product', 'invoice_id.product_id', 'product.id')
            ->select('invoice_id.*', 'product.name as product_name')

            ->get();


        return view('sell.sell', ['sells' => $sells, 'products' => $products, 'invoices' => $invoices]);
    }
    public function insert_sell(Request $request)
    {




        $request->validate([
            'product_id' => 'required|numeric|exists:product,id',
            'quantity'   => 'required|numeric|gt:0',
            'price'      => 'required|numeric|gt:0',
            'invoice_id' => 'required|numeric|exists:invoice,id',
        ]);

        $product = DB::table('pi')->where('product_id', $request->product_id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }


          // Check if the requested quantity is available
          if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock available. Only ' . $product->quantity . ' items in stock.');
        }


        $maxOrderNumber = DB::table('invoice')->max('order_number') ?? 0;

        $total = $request->quantity * $request->sell_price;
        DB::table('invoice')->insert([
            'order_number' => $maxOrderNumber + 1,
            'discount'     => 0,

        ]);
        $total = $request->quantity * $request->sell_price;
        DB::table('invoice_id')->insert([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'price'      => $request->price,
            'invoice_id' => $request->invoice_id,

        ]);
        DB::table('pi')->where('product_id', $request->product_id)->update(['quantity' => $product->quantity - $request->quantity]);

        

        return redirect('sell');

    }
}
