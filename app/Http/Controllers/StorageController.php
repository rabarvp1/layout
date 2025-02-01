<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{

    public function storage()
    {
        return view('storage.storage');
    }

    public function getData_storage()
    {
        $products = DB::table('product')
            ->join('purchase_product', 'product.id', '=', 'purchase_product.product_id')
            ->join('cat', 'cat.id', '=', 'product.cat_id')
            ->leftJoin('sell_product', 'product.id', 'sell_product.product_id')
            ->selectRaw('
                product.name as product_name,
                SUM(purchase_product.quantity - COALESCE(sell_product.quantity, 0)) AS total_quantity,
                AVG(purchase_product.cost) as avg_cost,
                cat.name as category_name
            ')
            ->groupBy('product.id')
            ->havingRaw('SUM(purchase_product.quantity) > 0')
            ->get();

        return response()->json(['data' => $products]);
    }

}
