<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class income extends Controller
{

    public function mergedData()
    {

        $mergedData = DB::table('product')
            ->Join('invoice_id', 'product.id', '=', 'invoice_id.product_id')
            ->Join('pi', 'product.id', '=', 'pi.product_id')
            ->select(
                'product.name as product_name',
                'invoice_id.quantity as sold_quantity',
                'invoice_id.price as selling_price',
                'pi.quantity as bought_quantity',
                'pi.cost as buying_price',
            )
            ->get();


        // Pass data to view
        return view('income.income', compact('mergedData'));}
}
