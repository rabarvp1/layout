<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class income extends Controller
{

    public function mergedData()
    {

        $mergedData = DB::table('product')
            ->Join('sell', 'product.id', '=', 'sell.product_id')
            ->Join('storage', 'product.id', '=', 'storage.product_id')
            ->select(
                'product.name as product_name',
                'product.price as product_price',
                'sell.quantity as sold_quantity',
                'sell.sell_price as selling_price',
                'storage.quantity as bought_quantity',
                'storage.purchease_price as buying_price',
            )
            ->get();


        // Pass data to view
        return view('income.income', compact('mergedData'));}
}
