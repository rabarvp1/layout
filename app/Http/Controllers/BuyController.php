<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyController extends Controller
{
    public function buy()
    {
        $supliers  = DB::table('suplier')->get();
        $purchases = DB::table('purchase')->get();

        return view('buy.buy', compact('purchases', 'supliers'));
    }
    public function insert(Request $request)
    {
        // $validated = $request->validate([
        //     'product_id' => 'required|numeric|exists:product,id',
        //     'quantity'   => 'required|numeric|gt:0',
        //     'cost'       => 'required|numeric|gt:0',
        // ]);
        
        DB::transaction(function () use ($request) {
            $maxOrderNumber = DB::table('purchase')->max('order_number') ?? 0;

            $purchaseId = DB::table('purchase')->insertGetId([

                'order_number' => $maxOrderNumber + 1,
                'discount'     => 0,
                'note'         => $request->note,
                'created_at'   => now(),
            ]);

            for ($i = 0; $i < count($request->product_id); $i++) {
                DB::table('purchase_product')->insert([
                    'quantity'    => $request->quantity[$i],
                    'cost'        => $request->cost[$i],
                    'product_id'  => $request->product_id[$i],
                    'purchase_id' => $purchaseId,
                ]);
            }

        });

        return redirect('buy');
    }

    public function getData()
    {
        $search   = request('search');
        $products = DB::table('product')
            ->whereLike('name', '%' . $search . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->name,
                    'label' => $item->name,
                    'html'  => '<tr>
                    <td>' . $item->name . '</td>
                    <td>
                        <input type="number" class="form-control" name="quantity[]" value="1">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="cost[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="single_price[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="form-control" name="multi_price[]" value="0">
                    </td>
                    <input type="hidden" name="product_id[]" value="' . $item->id . '">
                    </tr>',
                ];
            });

        return response()->json($products);
    }

}
