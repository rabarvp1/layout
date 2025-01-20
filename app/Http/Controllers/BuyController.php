<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyController extends Controller
{
    public function buy()
    {
        $products = DB::table('product')->get();
        $po       = DB::table('po')->get();

        $pi = DB::table('pi')
            ->join('product', 'pi.product_id', 'product.id')
            ->select(
                'pi.*',
                'product.name as product_name',
            )
            ->get();
        return view('buy.buy', ['products' => $products, 'pi' => $pi, 'po' => $po]);
    }
    public function insert(Request $request)
    {

        $product = DB::table('product')->where('id', $request->product_id)->first();

        $product_id = DB::table('pi')->where('product_id', $request->product_id)->first();

        $validated =$request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|gt:0',
            'cost'       => 'required|numeric|gt:0',
            'po_id'      => 'required|numeric|gt:0',

        ]);

        // |exists:product,cat_id
        $maxOrderNumber = DB::table('po')->max('order_number') ?? 0;

        DB::table('po')->insert([
            'order_number' => $maxOrderNumber + 1,
            'discount'     => 0,

        ]);

        $existingPurchase = DB::table('pi')
            ->where('product_id', $validated['product_id'])
            ->first();

        // If the product has been bought, update the existing row
        if ($existingPurchase) {
            DB::table('pi')
                ->where('product_id', $existingPurchase->product_id)
                ->update([

                    'quantity' => $product_id->quantity + $request->quantity


                ]);
        } else {
            // If the product has not been bought, insert a new row
            DB::table('pi')->insert([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'cost'       => $request->cost,
            'po_id'      => $request->po_id,

        ]);
        }



        return redirect('buy');

    }

}
