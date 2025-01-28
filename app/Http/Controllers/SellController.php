<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class SellController extends Controller
{

    public function sell()
    {
        $customers = DB::table('customer')->get();

        $products = DB::table('product')->get();
        $invoices = DB::table('invoice')->get();
        $sells    = DB::table('sell_product')
            ->join('product', 'sell_product.product_id', 'product.id')
            ->select('sell_product.*', 'product.name as product_name')

            ->get();

        return view('sell.sell', ['sells' => $sells, 'products' => $products, 'invoices' => $invoices, 'customers' => $customers]);
    }
    public function insert_sell(Request $request)
    {
        // Validate input data

        DB::transaction(function () use ($request) {

            $request->validate([
                'customer'     => 'required|string|exists:customer,name', // Ensure the customer exists
                'product_id'   => 'required|array',
                'note'         => 'nullable|string|max:255',
                'product_id'   => 'required|array',
                'product_id.*' => 'required|numeric|exists:product,id',
                'quantity'     => 'required|array',
                'quantity.*'   => 'required|numeric|gt:0',
                'sell_price'   => 'required|array',
                'sell_price.*' => 'required|numeric|gt:0',
            ]);

            // Get the current max order number and create a new invoice
            $maxOrderNumber = DB::table('invoice')->max('order_number') ?? 0;

            $invoiceId = DB::table('invoice')->insertGetId([
                'customer'     => $request->customer,
                'sum'          => 0,
                'note'         => $request->note,
                'total'        => 0,
                'order_number' => $maxOrderNumber + 1,
                'discount'     => 0,
                'created_at'   => now(),
            ]);

            $totalSum = 0; // Variable to track the total sum of the invoice

            foreach ($request->product_id as $index => $productId) {
                $product          = DB::table('purchase_product')->where('product_id', $productId)->first();
                $existingPurchase = DB::table('purchase_product')->where('product_id', $productId)->first();

                // Check if the product exists in purchase_product
                if (! $product) {
                    alert('product not fount');
                    throw new \Exception("Product with ID $productId not found in stock.");
                }

                $requestedQuantity = $request->quantity[$index];

                // Check if the requested quantity is available
                if ($product->quantity < $requestedQuantity) {
                    return response()->json([
                        'error' => "Insufficient stock for product ID $productId. Only $product->quantity items available."
                    ]);
                    // throw new \Exception("Insufficient stock for product ID $productId. Only $product->quantity items available.");
                }

                $sellPrice = $request->sell_price[$index];
                $sum       = $requestedQuantity * $sellPrice;

                // Insert into sell_product

                DB::table('sell_product')->insert([
                    'product_id' => $productId,
                    'quantity'   => $requestedQuantity,
                    'sell_price' => $sellPrice,
                    'sum'        => $sum,
                    'invoice_id' => $invoiceId,
                ]);

                // Decrement the stock in purchase_product
                DB::table('purchase_product')
                    ->where('product_id', $productId)
                    ->decrement('quantity', $requestedQuantity);

                $totalSum += $sum;
                if ($existingPurchase) {

                    $currentQTY = DB::table('storage')->where('product_id', $productId)->first();

                    DB::table('storage')
                        ->where('product_id', $existingPurchase->product_id)
                        ->update([
                            'quantity' => $currentQTY->quantity - $requestedQuantity,

                        ]);
                } else {

                    redirect('sell')->with('failed', 'we dont have the product in storage');
                }
            }

            // Update the total and sum fields in the invoice
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
                return [
                    'value' => $item->name,
                    'label' => $item->name,
                    'html'  => sprintf(
                        '<tr>
                        <td>%s</td>
        <td><input type="number" class="form-control" name="quantity[]" value="1"></td>

        <td><input type="number" class="form-control" name="sell_price[]" value="0"></td>



        <input type="hidden" name="product_id[]" value="%s">
        <td>
            <button type="button" class="btn btn-danger btn-sm sale-color delete-btn" data-id="%s">Delete</button>
        </td>
    </tr>',
                        htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8'),
                        htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8')
                    ),
                ];
            });

        return response()->json($products);
    }
// delete the one row in buy modal
    public function delete_row_sell(Request $request)
    {
        $id = $request->input('id');
        // Perform deletion logic (e.g., DB::table('product')->where('id', $id)->delete();)
        return response()->json(['message' => 'Product deleted successfully.']);
    }

    public function deleteInvoice($id)
    {
        // Delete the product by id using Query Builder
        DB::table('invoice')->where('id', $id)->delete();

        // Redirect back to the product page with a success message
        return redirect('sell')->with('success', 'Product deleted successfully!');
    }

// invoice view

    public function view_invoice($id)
    {

        $invoice = DB::table('invoice')->where('id', $id)->first();

        $sell_product = DB::table('sell_product')->where('invoice_id', $id)
            ->join('product', 'sell_product.product_id', 'product.id')
            ->select('sell_product.*', 'product.name as product_name')
            ->get();

        return view('sell.view', compact('invoice', 'sell_product'));

    }

}
