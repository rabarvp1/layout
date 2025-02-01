<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class income extends Controller
{

    public function mergedData()
    {

        $mergedData = DB::table('product')
            ->Join('sell_product', 'product.id', '=', 'sell_product.product_id')
            ->Join('purchase_product', 'product.id', '=', 'purchase_product.product_id')
            ->select(
                'product.name as product_name',
                'sell_product.quantity as sold_quantity',
                'sell_product.sell_price as selling_price',
                'purchase_product.quantity as bought_quantity',
                'purchase_product.cost as buying_price',
            )
            ->get();


        return view('income.income', compact('mergedData'));}

       
}
