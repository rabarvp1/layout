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



        DB::table('suplier_payment')->insert([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
            'suplier_id' => $id,
        ]);

        return redirect('suplier/profile/' . $id);

    }

    public function delete_payment(Request $request, $paymentId)
    {

       DB::table('suplier_payment')->where('id', $paymentId)->delete();


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



        DB::table('suplier_payment')->where('id', $paymentId)->update([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => now(),
            'note'       => $request->note,
        ]);



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
            'type'        => 'required|string|in:Receiving money,Payments',
            'amount'      => 'required|integer|gt:0',
            'customer_id' => 'exists:customer,id',
            'note'        => 'nullable|string|max:255',

        ]);



        DB::table('customer_payment')->insert([
            'type'        => $request->type,
            'amount'      => $request->amount,
            'created_at'  => $request->created_at,
            'note'        => $request->note,
            'customer_id' => $id,
        ]);

        return redirect('customer/profile/' . $id);

    }

    public function delete_payment_customer(Request $request, $paymentId )
    {

        DB::table('customer_payment')->where('id', $paymentId)->delete();


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


        DB::table('customer_payment')->where('id', $paymentId)->update([
            'type'       => $request->type,
            'amount'     => $request->amount,
            'created_at' => $request->created_at,
            'note'       => $request->note,
        ]);

      

        return redirect('/customer/profile/' . $customerId)->with('success', 'Profile updated successfully');
    }

}
