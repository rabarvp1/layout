<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StorageController extends Controller
{

    public function storage()
    {
        return view('storage.storage'); // Only return the view, data will be loaded via AJAX
    }

    public function getData_storage()
    {
        $products = DB::table('product')
            ->join('purchase_product', 'product.id', '=', 'purchase_product.product_id')
            ->join('cat', 'cat.id', '=', 'product.cat_id')
            ->selectRaw('
                product.name as product_name,
                SUM(purchase_product.quantity) as total_quantity,
                AVG(purchase_product.cost) as avg_cost,
                cat.name as category_name
            ')
            ->groupBy('product.id', 'cat.id')
            ->havingRaw('SUM(purchase_product.quantity) > 0') // Ensure only products with purchases are shown
            ->get();

        return response()->json(['data' => $products]);
    }

}
