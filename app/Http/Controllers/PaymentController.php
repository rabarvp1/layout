<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function profile_suplier($id)
    {

        $suplier = DB::table('suplier')->where('id', $id)->firstOrFail();

        $payments = DB::table('suplier_payment')->where('suplier_id', $id)->get();

        return view('suplier.profile', compact('suplier', 'payments'));
    }

    public function suplier_payment(Request $request, $id)
    {
        $request->validate([
            'type'       => 'required|string|in:Receiving money,Payments',
            'amount'     => 'required|integer|gt:0',
            'suplier_id' => 'exists:suplier,id',
            'note'       => 'nullable|string|max:255',

        ]);

        $currentBalance = DB::table('suplier_payment')
            ->where('suplier_id', $id)
            ->latest('id')
            ->first()->balance ?? 0;

        $newBalance = $currentBalance + $request->amount;

        if ($request->type === 'Receiving money') {
            $newBalance = $currentBalance + $request->amount;
        } elseif ($request->type === 'Payments') {
            $newBalance = $currentBalance - $request->amount;
        }

        DB::table('suplier_payment')->insert([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
            'suplier_id' => $id,
            'balance'    => $newBalance,
        ]);

        return redirect('suplier/profile/' . $id);

    }

    public function delete_payment($id)
    {

        DB::table('suplier_payment')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Payment deleted successfully');
    }

    public function edit_suplier_profile($paymentId, $supplierId)
    {

        $suplier_payment = DB::table('suplier_payment')->where('id', $paymentId)->firstOrFail();

        $suplier = DB::table('suplier')->where('id', $supplierId)->firstOrFail();

        return view('suplier.edit_profile', compact('suplier_payment', 'suplier'));
    }
    public function update_suplier_profile(Request $request, $paymentId, $supplierId)
    {
        $request->validate([
            'type'   => 'required|string|in:Receiving money,Payments',
            'amount' => 'required|integer|gt:0',
            'note'   => 'nullable|string|max:255',
        ]);

        $payment = DB::table('suplier_payment')->where('id', $paymentId)->first();
        if (! $payment) {
            return back()->with('error', 'Payment not found!');
        }

        $previousBalance = DB::table('suplier_payment')
            ->where('suplier_id', $supplierId)
            ->where('id', '<', $paymentId)
            ->latest('id')
            ->first()->balance ?? 0;

        $transactions = DB::table('suplier_payment')
            ->where('suplier_id', $supplierId)
            ->where('id', '>=', $paymentId)
            ->orderBy('id')
            ->get();

        DB::table('suplier_payment')->where('id', $paymentId)->update([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => now(),
            'note'       => $request->note,
        ]);

        $newBalance = $previousBalance;
        foreach ($transactions as $transaction) {
            if ($transaction->id == $paymentId) {
                $amount = $request->amount;
                $type   = $request->type;
            } else {
                $amount = $transaction->amount;
                $type   = $transaction->type;
            }

            if ($type === 'Receiving money') {
                $newBalance += $amount;
            } elseif ($type === 'Payments') {
                $newBalance -= $amount;
            }

            DB::table('suplier_payment')->where('id', $transaction->id)->update([
                'balance' => $newBalance,
            ]);
        }

        return redirect('/suplier/profile/' . $supplierId)->with('success', 'Profile updated successfully');
    }

    //--------------------------------------------------------------------------------
    // customer payment

    public function profile_customer($id)
    {

        // $products = DB::table('product')
        // ->join('purchase_product', 'product.id', '=', 'purchase_product.product_id')
        // ->join('cat', 'cat.id', '=', 'product.cat_id')
        // ->leftJoin('sell_product', 'product.id', 'sell_product.product_id')
        // ->selectRaw('
        //     product.name as product_name,
        //    (purchase_product.quantity) - SUM(sell_product.quantity) AS total_quantity,
        //     AVG(purchase_product.cost) as avg_cost,
        //     cat.name as category_name
        // ')
        // ->groupBy('product.id')
        // ->havingRaw('SUM(purchase_product.quantity) > 0')
        // ->get();

        // $products = DB::table('product')
        //     ->join('purchase_product as pp', 'product.id', '=', 'pp.product_id')
        //     ->join('cat', 'cat.id', '=', 'product.cat_id')
        //     ->leftJoin('sell_product as sp', 'product.id', '=', 'sp.product_id')
        //     ->selectRaw('
        //     product.name as product_name,
        //     product.id as product_id,
        //     product.name as product_name,
        //     COALESCE(SUM(pp.quantity), 0) as total_purchased,
        //     COALESCE(SUM(sp.quantity), 0) as total_sold,
        //     COALESCE(SUM(pp.quantity), 0) - COALESCE(SUM(sp.quantity), 0) as total_quantity,
        //     cat.name as category_name
        // ')
        //     ->groupBy('product.id', 'product.name', 'cat.name')
        //     ->havingRaw('SUM(pp.quantity) > 0')
        //     ->get();
    


        // $products = DB::table('product as p')
        //     ->leftJoin('cat as c', 'p.cat_id', '=', 'c.id')
        //     ->leftJoin('purchase_product as pp', 'p.id', '=', 'pp.product_id')
        //     ->leftJoinSub(
        //         DB::table('sell_product')
        //             ->select('product_id', DB::raw('MAX(id) as last_sale_id'))
        //             ->groupBy('product_id'),
        //         'last_sale',
        //         'p.id',
        //         '=',
        //         'last_sale.product_id'
        //     )
        //     ->leftJoin('sell_product as sp', 'last_sale.last_sale_id', '=', 'sp.id')
        //     ->select(
        //         'p.id as product_id',
        //         'p.name as product_name',
        //         'c.name as category_name',
        //         DB::raw('COALESCE(SUM(pp.quantity), 0) as total_purchased'),
        //         DB::raw('COALESCE(sp.quantity, 0) as last_sold_quantity'),
        //         DB::raw('COALESCE(SUM(pp.quantity), 0) - COALESCE(sp.quantity, 0) as total_quantity'),
        //     )
        //     ->groupBy('p.id', 'p.name', 'c.name', 'sp.quantity')
        //     ->get();

        $customer = DB::table('customer')->where('id', $id)->firstOrFail();

        $payments = DB::table('customer_payment')->where('customer_id', $id)->get();

        return view('customer.profile', compact('customer', 'payments'));
    }

    public function customer_payment(Request $request, $id)
    {
        $request->validate([
            'type'        => 'required|string|in:Receiving money,Payments',
            'amount'      => 'required|integer|gt:0',
            'customer_id' => 'exists:customer,id',
            'note'        => 'nullable|string|max:255',

        ]);

        $currentBalance = DB::table('customer_payment')
            ->where('customer_id', $id)
            ->latest('id')
            ->first()->balance ?? 0;

        $newBalance = $currentBalance + $request->amount;

        if ($request->type === 'Receiving money') {
            $newBalance = $currentBalance + $request->amount;
        } elseif ($request->type === 'Payments') {
            $newBalance = $currentBalance - $request->amount;
        }

        DB::table('customer_payment')->insert([
            'type'        => $request->type,
            'amount'      => $request->amount,
            'created_at'  => $request->created_at,
            'note'        => $request->note,
            'customer_id' => $id,
            'balance'     => $newBalance,
        ]);

        return redirect('customer/profile/' . $id);

    }

    public function delete_payment_customer($id)
    {

        DB::table('customer_payment')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Payment deleted successfully');
    }

    public function edit_customer_profile($paymentId, $customerId)
    {

        $customer_payment = DB::table('customer_payment')->where('id', $paymentId)->firstOrFail();

        $customer = DB::table('customer')->where('id', $customerId)->firstOrFail();

        return view('customer.edit_profile', compact('customer_payment', 'customer'));
    }

    public function update_customer_profile(Request $request, $paymentId, $customerId)
    {
        $request->validate([
            'type'   => 'required|string|in:Receiving money,Payments',
            'amount' => 'required|integer|gt:0',
            'note'   => 'nullable|string|max:255',
        ]);

        $customer_payment = DB::table('customer_payment')->where('id', $paymentId)->first();
        if (! $customer_payment) {
            return back()->with('error', 'Payment not found!');
        }

        $previousBalance = DB::table('customer_payment')
            ->where('customer_id', $customerId)
            ->where('id', '<', $paymentId)
            ->latest('id')
            ->first()->balance ?? 0;

        $transactions = DB::table('customer_payment')
            ->where('customer_id', $customerId)
            ->where('id', '>=', $paymentId)
            ->orderBy('id')
            ->get();

        DB::table('customer_payment')->where('id', $paymentId)->update([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
        ]);

        $newBalance = $previousBalance;
        foreach ($transactions as $transaction) {
            if ($transaction->id == $paymentId) {
                $amount = $request->amount;
                $type   = $request->type;
            } else {
                $amount = $transaction->amount;
                $type   = $transaction->type;
            }

            if ($type === 'Receiving money') {
                $newBalance -= $amount;
            } elseif ($type === 'Payments') {
                $newBalance += $amount;
            }

            DB::table('customer_payment')->where('id', $transaction->id)->update([
                'balance' => $newBalance,
            ]);
        }

        return redirect('/customer/profile/' . $customerId)->with('success', 'Profile updated successfully');
    }

}
