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

    public function getData_storage()
{
    $products = DB::table('storage')
        ->join('product', 'product.id', '=', 'storage.product_id')
        ->join('cat', 'cat.id', '=', 'product.cat_id')
        ->select('product.name as product_name', 'storage.quantity', 'storage.avg_cost', 'cat.name as cat')
        ->get()
        ->map(function ($item) {
            return [
                'value' => $item->product_name,
                'label' => $item->product_name,
                'html'  => sprintf(
                    '<tr>
                        <td>%s</td>
                        <td>%s</td>
                        <td>$%s</td>
                        <td>%s</td>
                    </tr>',
                    htmlspecialchars($item->product_name, ENT_QUOTES, 'UTF-8'),
                    $item->quantity,
                    number_format($item->avg_cost, 2),  // Format the cost
                    htmlspecialchars($item->cat, ENT_QUOTES, 'UTF-8')
                ),
            ];
        });

    return response()->json($products);
}


}
