<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class StorageController extends Controller
{

    public function storage()
    {
        return view('storage.storage');
    }

    public function getData_storage(Request $request)
    {

        if ($request->ajax()) {

            $products = DB::table('product')
            ->join(DB::raw('(SELECT product_id, SUM(quantity) as total_purchase, AVG(purchase_product.cost) as avg_cost FROM purchase_product GROUP BY product_id) purchase_product'), function ($join) {
                $join->on('purchase_product.product_id', '=', 'product.id');
            })
            ->join('cat', 'cat.id', '=', 'product.cat_id')
            ->leftJoin(DB::raw('(SELECT product_id, SUM(quantity) as total_sale FROM sell_product GROUP BY product_id) sell_product'), function ($join) {
                $join->on('sell_product.product_id', '=', 'product.id');
            })
            ->select(
                'product.name as product_name',
                'cat.name as category_name',
                DB::raw('COALESCE(purchase_product.avg_cost, 0) as avg_cost'),
                DB::raw('COALESCE(purchase_product.total_purchase, 0) - COALESCE(sell_product.total_sale, 0) as total_quantity'),
            )
            ->when($request->search, function ($query, $search) {
                $query->whereLike('product.name', "%{$search}%");
            })
            ->groupBy('product.id')
            ->having('total_quantity', '>', 0);


            return DataTables::of($products) ->make(true);


        }

    }

}
