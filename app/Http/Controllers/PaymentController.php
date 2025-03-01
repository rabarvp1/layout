<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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
            'created_at' => now(),
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
            'created_at' => $request->created_at,
            'note'       => $request->note,
        ]);

        return redirect('/suplier/profile/' . $supplierId)->with('success', 'Profile updated successfully');
    }

    public function suplier_payment_index(Request $request)
    {
        $supplierId = $request->supplier_id;

        if (! $request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }
        $payments = DB::table('suplier_payment')
        ->where('suplier_id', $supplierId)
        ->select('id', 'type', 'created_at', 'amount', 'note');

    // Apply date filter if start_date is provided
    if ($request->has('start_date_1') && $request->start_date_1) {
        $payments->whereDate('created_at', '>=', $request->start_date_1);
    }

    // Apply date filter if end_date is provided
    if ($request->has('end_date_1') && $request->end_date_1) {
        $payments->whereDate('created_at', '<=', $request->end_date_1);
    }

    $payments = $payments->get();

        return DataTables::of($payments)
            ->addIndexColumn()
            ->addColumn('receipt_type', function ($row) {
                return $row->type == 'Payments'
                ? __('index.payment') . " ({$row->id})"
                : __('index.receiving_money') . " ({$row->id})";
            })
            ->addColumn('add', fn($row) => $row->type == 'Receiving money' ? '$' . number_format($row->amount, 2) : '')
            ->addColumn('minus', fn($row) => $row->type == 'Payments' ? '$' . number_format($row->amount, 2) : '')
            ->addColumn('balance', function ($row) {
                static $balance = 0;
                $balance += ($row->type == 'Receiving money') ? $row->amount : -$row->amount;
                return '$' . number_format($balance, 2);
            })

            ->addColumn('action', function ($row) {
                $editUrl     = url('/suplier/edit/' . $row->id);
                $deleteUrl   = url('/suplier/delete/' . $row->id);
                $editLabel   = __('index.edit');
                $deleteLabel = __('index.delete');
                return '<div class="dropdown text-center">
                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ph-list"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <form action="' . $editUrl . '" method="GET" style="display: inline;">
                            <button type="submit" class="dropdown-item">' . $editLabel . '</button>
                        </form>
                    </li>
                    <li>
                        <form action="' . $deleteUrl . '" method="POST" style="display: inline;"
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="dropdown-item text-danger">' . $deleteLabel . '</button>
                        </form>
                    </li>
                </ul>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);


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

    public function delete_payment_customer(Request $request, $paymentId)
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

    public function customer_payment_index(Request $request)
    {

        $customerId = $request->customer_id;

        if (! $request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $payments = DB::table('customer_payment')
            ->where('customer_id', $customerId)
            ->select('id', 'type', 'created_at', 'amount', 'note');

        // Apply date filter if start_date is provided
        if ($request->has('start_date') && $request->start_date) {
            $payments->whereDate('created_at', '>=', $request->start_date);
        }

        // Apply date filter if end_date is provided
        if ($request->has('end_date') && $request->end_date) {
            $payments->whereDate('created_at', '<=', $request->end_date);
        }

        $payments = $payments->get();

        return DataTables::of($payments)
            ->addIndexColumn()
            ->addColumn('receipt_type', function ($row) {
                return $row->type == 'Payments'
                ? __('index.payment') . " ({$row->id})"
                : __('index.receiving_money') . " ({$row->id})";
            })
            ->addColumn('add', fn($row) => $row->type == 'Payments' ? '$' . number_format($row->amount, 2) : '')
            ->addColumn('minus', fn($row) => $row->type == 'Receiving money' ? '$' . number_format($row->amount, 2) : '')
            ->addColumn('balance', function ($row) {
                static $balance = 0;
                $balance -= ($row->type == 'Receiving money') ? $row->amount : -$row->amount;
                return '$' . number_format($balance, 2);
            })

            ->addColumn('action', function ($row) {
                $editUrl     = url('/customer/edit/' . $row->id);
                $deleteUrl   = url('/customer/delete/' . $row->id);
                $editLabel   = __('index.edit');
                $deleteLabel = __('index.delete');
                return '<div class="dropdown text-center">
                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ph-list"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <form action="' . $editUrl . '" method="GET" style="display: inline;">
                            <button type="submit" class="dropdown-item">' . $editLabel . '</button>
                        </form>
                    </li>
                    <li>
                        <form action="' . $deleteUrl . '" method="POST" style="display: inline;"
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="dropdown-item text-danger">' . $deleteLabel . '</button>
                        </form>
                    </li>
                </ul>
            </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }
}
