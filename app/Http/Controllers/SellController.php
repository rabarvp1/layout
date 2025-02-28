<?php
namespace App\Http\Controllers;

use function Laravel\Prompts\alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SellController extends Controller
{

    public function sell()
    {
        $customers = DB::table('customer')->get();

        $products = DB::table('product')->get();
        $invoices = DB::table('invoice')->join('customer', 'invoice.customer_id', 'customer.id')
            ->select('invoice.*', 'customer.name as customer_name')
            ->get();
        $sells = DB::table('sell_product')
            ->join('product', 'sell_product.product_id', 'product.id')
            ->select('sell_product.*', 'product.name as product_name')

            ->get();

        return view('sell.sell', ['sells' => $sells, 'products' => $products, 'invoices' => $invoices, 'customers' => $customers]);
    }
    public function insert_sell(Request $request)
    {

        DB::transaction(function () use ($request) {

            $request->validate([
                'customer_id.*' => 'required|numeric|exists:customer,id',
                'product_id'    => 'required|array',
                'note'          => 'nullable|string|max:255',
                'product_id'    => 'required|array',
                'product_id.*'  => 'required|numeric|exists:product,id',
                'quantity'      => 'required|array',
                'quantity.*'    => 'required|numeric|gt:0',
                'sell_price'    => 'required|array',
                'sell_price.*'  => 'required|numeric|gt:0',
            ]);

            $maxOrderNumber = DB::table('invoice')->max('order_number') ?? 0;

            $invoiceId = DB::table('invoice')->insertGetId([
                'customer_id'  => $request->customer_id,
                'sum'          => 0,
                'note'         => $request->note,
                'total'        => 0,
                'order_number' => $maxOrderNumber + 1,
                'discount'     => 0,
                'created_at'   => now(),
            ]);

            $totalSum = 0;
            foreach ($request->product_id as $key => $productId) {
                $product = DB::table('purchase_product')->where('product_id', $productId)->first();

                if (! $product) {
                    alert('product not fount');
                    throw new \Exception("Product with ID $productId not found in stock.");
                }

                $requestedQuantity = $request->quantity[$key];

                if ($product->quantity < $requestedQuantity) {
                    return response()->json([
                        'error' => "Insufficient stock for product ID $productId. Only $product->quantity items available.",
                    ]);
                }

                $sellPrice = $request->sell_price[$key];
                $sum       = $requestedQuantity * $sellPrice;

                DB::table('sell_product')->insert([
                    'product_id' => $productId,
                    'quantity'   => $requestedQuantity,
                    'sell_price' => $sellPrice,
                    'sum'        => $sum,
                    'invoice_id' => $invoiceId,
                ]);



                $totalSum += $sum;

            }

            DB::table('invoice')->where('id', $invoiceId)->update([
                'sum'   => $totalSum,
                'total' => $totalSum - ($request->discount ?? 0),
            ]);
        });

        return redirect('sell')->with('success', 'Sale added successfully.');
    }

    public function getData_sell()
    {

        $search   = request('search');
        $products = DB::table('product')
            ->whereLike('name', '%' . $search . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                     $deleteLabel = __('index.delete');
                 return [
                    'value' => htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'),
                    'label' => htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'),
                    'html'  => sprintf(

                        '<tr class="text-center">
                            <td class="align-middle">%s</td>
                            <td class="align-middle">
                                <input type="number" class="form-control text-center" name="quantity[]" value="1">
                            </td>
                            <td class="align-middle">
                                <input type="number" class="form-control text-center" name="sell_price[]" value="0">
                            </td>
                            <td class="align-middle">
                                <input type="hidden" name="product_id[]" value="%s">
                                <button type="button" class="btn btn-danger btn-sm sale-color delete-btn" data-id="%s">' . $deleteLabel . '</button>
                            </td>
                        </tr>',
                        htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'), // First %s (Product Name)
                        htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8'), // Second %s (Hidden Product ID)
                        htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8')  // Third %s (Button Data ID)
                    ),
                ];
            });


        return response()->json($products);
    }
    public function delete_row_sell(Request $request)
    {
        dd($request->all());
        // $id = $request->input('id');
        return response()->json(['message' => 'Product deleted successfully.']);
    }

    public function deleteInvoice($id)
    {
        DB::table('invoice')->where('id', $id)->delete();

        return redirect('sell')->with('success', 'Product deleted successfully!');
    }

    public function search_customer(Request $request)
    {
        $search = $request->get('search', '');

        $customers = DB::table('customer')
            ->select('id', 'name')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->limit(10)
            ->get();

        return response()->json($customers);
    }

// invoice view

    public function view_invoice($id)
    {

        $invoice = DB::table('invoice')->join('customer', 'invoice.customer_id', 'customer.id')
            ->select('invoice.*', 'customer.name as customer_name')
            ->where('invoice.id', $id)->firstOrFail();

        $sell_product = DB::table('sell_product')->where('invoice_id', $id)
            ->join('product', 'sell_product.product_id', 'product.id')
            ->select('sell_product.*', 'product.name as product_name')
            ->get();

        return view('sell.view', compact('invoice', 'sell_product'));

    }

    // edit invoice
    public function edit_invoice($id)
    {

        $invoices = DB::table('invoice')
            ->join('customer', 'invoice.customer_id', 'customer.id')
            ->select('invoice.*', 'customer.name as customer_name')
            ->where('invoice.id', $id)
            ->firstOrFail();

        $sell_products = DB::table('sell_product')->where('invoice_id', $id)
            ->join('product', 'sell_product.product_id', 'product.id')
            ->select('sell_product.*', 'product.name as product_name')
            ->get();

        return view('sell.edit', compact('invoices', 'sell_products'));

    }

    public function update_invoice(Request $request, $id)
    {

        $request->validate([
            'customer_id.*' => 'required|numeric|exists:customer,id',
            'note'          => 'nullable|string|max:255',

            'quantity'      => 'required|array',
            'quantity.*'    => 'required|numeric|gt:0',
            'sell_price'    => 'required|array',
            'sell_price.*'  => 'required|numeric|gt:0',
        ]);

        $invoiceId = DB::table('invoice')->where('id', $id)->update([
            'customer_id' => $request->customer_id,
            'note'        => $request->note,
            'created_at'  => now(),
        ]);

        $totalSum = 0;
        DB::table('sell_product')->where('invoice_id')->whereNotIn('product_id', $request->product_id)->delete();

        foreach ($request->product_id as $key => $productId) {

            $product = DB::table('purchase_product')->where('product_id', $productId)->firstOrFail();

            if (! $product) {
                alert('product not fount');
                throw new \Exception("Product with ID $productId not found in stock.");
            }

            $requestedQuantity = $request->quantity[$key];

            $sellPrice = $request->sell_price[$key];
            $sum       = $requestedQuantity * $sellPrice;

            DB::table('sell_product')->updateOrInsert(['product_id' => $productId, 'invoice_id' => $id], [
                'quantity'   => $requestedQuantity,
                'sell_price' => $sellPrice,
                'sum'        => $sum,
            ]);

            $totalSum += $sum;

        }

        return redirect('sell')->with('success', 'Product updated successfully!');

    }

    public function sell_index(Request $request)
    {

        if ($request->ajax()) {

            $invoices = DB::table('invoice')
            ->leftJoin('customer', 'invoice.customer_id', '=', 'customer.id')
            ->select('invoice.id', 'customer.name as customer', 'invoice.order_number', 'invoice.discount', 'invoice.note', 'invoice.created_at', 'invoice.total', 'invoice.sum')
            ->when($request->search, function ($query, $search) {
                $query->whereLike('invoice.order_number', "%{$search}%")
                    ->orWhereLike('customer.name', "%{$search}%");
                });

            return DataTables::of($invoices)

                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/sell/edit/' . $row->id );
                    $viewUrl   = url('/sell/single/view/' . $row->id);
                    $deleteUrl = url('/sell/delete/' . $row->id);

                    $editLabel   = __('index.edit');
                    $deleteLabel = __('index.delete');
                    $viewlabel   = __('index.view');
                    $confirmMessage = __('index.confirm_delete_cat');



                    return     '<div class="dropdown text-center">
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
                                   <form action="' . $viewUrl . '" method="GET" style="display: inline;">
                                       <button type="submit" class="dropdown-item">' . $viewlabel . '</button>
                                   </form>
                                 </li>
                             <li>
                             <form action="' . $deleteUrl . '" method="POST" style="display: inline;"
                                 onsubmit="return confirm(\'' . $confirmMessage . '\')">
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

        return view('sell.sell');
    }

}
