<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function customer()
    {

        $customers = DB::table('customer')->get();

        return view('customer.customer', [
            "customers" => $customers,
        ]);

    }

    public function inputCustomer(Request $request)
    {

        $request->validate([
            'name'         => 'required|string|max:50',
            'address'      => 'required|string|max:50',
            'phone_number' => 'required|gt:0|unique:customer,phone_number',

        ]);

        DB::table('customer')->insert([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('customer');

    }

    public function edit_customer($id)
    {

        $customer = DB::table('customer')->where('id', $id)->firstOrFail();

        return view('customer.edit', compact('customer'));

    }
    public function update_customer(Request $request, $id)
    {

        $request->validate([
            'name'    => 'required|string|max:50',
            'address' => 'required|string|max:50',

        ]);

        DB::table('customer')->where('id', $id)->update([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('customer')->with('success', 'Product updated successfully!');

    }

    public function delete_customer($id)
    {

        DB::table('customer')->where('id', $id)->delete();

        return redirect('customer')->with('success', 'customer deleted successfully!');
    }

    public function customer_index(Request $request)
    {

        if ($request->ajax()) {

            $customers = DB::table('customer')
                ->select('customer.name', 'customer.id', 'customer.address', 'customer.phone_number')
                ->when($request->search, function ($query, $search) {
                    $query->whereLike('name', "%{$search}%");

                });

                


            return DataTables::of($customers)

                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/customer/' . $row->id . '/edit');
                    $deleteUrl = url('/customer/' . $row->id);

                    $editLabel   = __('index.edit');
                    $deleteLabel = __('index.delete');

                    return '
                    <div class="dropdown text-center">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          ' . __('index.action') . '

                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="' . $editUrl . '" method="GET" style="display: inline;">
                                    <button type="submit" class="dropdown-item">' . $editLabel . '</button>
                                </form>
                            </li>

                            <li>
                                <form action="' . $deleteUrl . '" method="POST" style="display: inline;"
                                      onsubmit="return confirm(\'Are you sure you want to delete this product?\')">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="dropdown-item text-danger">' . $deleteLabel . '</button>
                                </form>
                            </li>
                        </ul>
                    </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('customer.customer');
    }

}
