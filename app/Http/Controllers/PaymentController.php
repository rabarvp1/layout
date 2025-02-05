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
// dd($supplierId,$paymentId);

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

        // Fetch the existing payment record
        $suplier_payment = DB::table('suplier_payment')->where('id', $paymentId)->firstOrFail();

        // Get the previous balance before the update
        $previousBalance = DB::table('suplier_payment')
            ->where('suplier_id', $supplierId)
            ->where('id', '<', $paymentId)
            ->latest('id')
            ->first()->balance ?? 0;

        // Get all transactions for this supplier, ordered by ID
        $transactions = DB::table('suplier_payment')
            ->where('suplier_id', $supplierId)
            ->orderBy('id')
            ->get();

        // Update the amount in the database
        DB::table('suplier_payment')->where('id', $paymentId)->update([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
        ]);

        // Recalculate balances for all transactions
        $newBalance = $previousBalance;
        foreach ($transactions as $transaction) {
            if ($transaction->id == $paymentId) {
                // Use the updated amount for this transaction
                $amount = $request->amount;
            } else {
                // Use the existing amount
                $amount = $transaction->amount;
            }

            // Update balance based on type
            if ($transaction->type === 'Receiving money') {
                $newBalance += $amount;
            } elseif ($transaction->type === 'Payments') {
                $newBalance -= $amount;
            }

            // Update the balance in the database
            DB::table('suplier_payment')->where('id', $transaction->id)->update([
                'balance' => $newBalance
            ]);
        }

        return redirect('/suplier/profile/' . $supplierId)->with('success', 'Profile updated successfully');
    }
    //--------------------------------------------------------------------------------
    // customer payment

    public function profile_customer($id)
    {

        $customer = DB::table('customer')->where('id', $id)->firstOrFail();

        $payments = DB::table('customer_payment')->where('customer_id', $id)->get();

        return view('customer.profile', compact('customer', 'payments'));
    }

    public function customer_payment(Request $request, $id)
    {
        $request->validate([
            'type'       => 'required|string|in:Receiving money,Payments',
            'amount'     => 'required|integer|gt:0',
            'customer_id' => 'exists:customer,id',
            'note'       => 'nullable|string|max:255',

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
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
            'customer_id' => $id,
            'balance'    => $newBalance,
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
// dd($customerId,$paymentId);

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

        // Fetch the existing payment record
        $customer_payment = DB::table('customer_payment')->where('id', $paymentId)->firstOrFail();

        // Get the previous balance before the update
        $previousBalance = DB::table('customer_payment')
            ->where('customer_id', $customerId)
            ->where('id', '<', $paymentId)
            ->latest('id')
            ->first()->balance ?? 0;

        // Get all transactions for this supplier, ordered by ID
        $transactions = DB::table('customer_payment')
            ->where('customer_id', $customerId)
            ->orderBy('id')
            ->get();

        // Update the amount in the database
        DB::table('customer_payment')->where('id', $paymentId)->update([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
        ]);

        // Recalculate balances for all transactions
        $newBalance = $previousBalance;
        foreach ($transactions as $transaction) {
            if ($transaction->id == $paymentId) {
                // Use the updated amount for this transaction
                $amount = $request->amount;
            } else {
                // Use the existing amount
                $amount = $transaction->amount;
            }

            // Update balance based on type
            if ($transaction->type === 'Receiving money') {
                $newBalance -= $amount;
            } elseif ($transaction->type === 'Payments') {
                $newBalance += $amount;
            }

            // Update the balance in the database
            DB::table('customer_payment')->where('id', $transaction->id)->update([
                'balance' => $newBalance
            ]);
        }

        return redirect('/customer/profile/' . $customerId)->with('success', 'Profile updated successfully');
    }


}
