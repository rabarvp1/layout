<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BuyController extends Controller
{
    public function buy()
    {
        $supliers = DB::table('suplier')->get();

        $purchases = DB::table('purchase')
            ->join('suplier', 'purchase.suplier_id', 'suplier.id')
            ->select('purchase.*', 'suplier.name as suplier')

            ->get();

        return view('buy.buy', compact('purchases', 'supliers'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'note'         => 'nullable|string|max:255',
            'product_id.*' => 'required|numeric|exists:product,id',
            'quantity'     => 'required|array|min:1',
            'quantity.*'   => 'required|numeric|gt:0',
            'cost'         => 'required|array|min:1',
            'cost.*'       => 'required|numeric|gt:0',
        ]);
        DB::transaction(function () use ($request) {
            $maxOrderNumber = DB::table('purchase')->max('order_number') ?? 0;
            $purchaseId     = DB::table('purchase')->insertGetId([

                'order_number' => $maxOrderNumber + 1,
                'sum'          => 0,
                'suplier_id'   => $request->suplier,
                'discount'     => 0,
                'note'         => $request->note,
                'total'        => 0,
                'created_at'   => now(),
            ]);
            $totalSum = 0;

            foreach ($request->product_id as $key => $productId) {
                $existingPurchase = DB::table('purchase_product')->where('product_id', $productId)->first();

                $requestedQuantity = $request->quantity[$key];
                $cost              = $request->cost[$key];
                $sum               = $cost * $requestedQuantity;

                DB::table('purchase_product')->insert([
                    'quantity'    => $requestedQuantity,
                    'cost'        => $cost,
                    'product_id'  => $productId,
                    'purchase_id' => $purchaseId,
                    'sum'         => $sum,
                ]);

                $totalSum += $sum;

            }

            // Update the total and sum fields in the purchase
            DB::table('purchase')->where('id', $purchaseId)->update([
                'sum'   => $totalSum,
                'total' => $totalSum - ($request->discount ?? 0),
            ]);

        });

        return redirect('buy');
    }

    public function getData()
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

        <td><input type="number" class="form-control" name="cost[]" value="0"></td>

        <td><input type="number" class="form-control" name="single_price[]" value="0"></td>

        <td><input type="number" class="form-control" name="multi_price[]" value="0"></td>
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
    public function deleteRow(Request $request)
    {
        $id = $request->input('id');
        return response()->json(['message' => 'Product deleted successfully.']);
    }

    // purchase view

    public function view_purchase($id)
    {

        $purchase = DB::table('purchase')
            ->join('suplier', 'purchase.suplier_id', 'suplier.id')
            ->select(
                'purchase.*',
                'suplier.name as suplier',
            )
            ->where('purchase.id', $id)
            ->firstOrFail();

        $purchase_product = DB::table('purchase_product')->where('purchase_id', $id)
            ->join('product', 'purchase_product.product_id', 'product.id')
            ->select('purchase_product.*', 'product.name as product_name')
            ->get();

        return view('buy.view', compact('purchase', 'purchase_product'));

    }
    //edit purchase
    public function edit_purchase($id)
    {

        $purchase = DB::table('purchase')
            ->join('suplier', 'purchase.suplier_id', 'suplier.id')
            ->select(
                'purchase.*',
                'suplier.name as suplier',
            )
            ->where('purchase.id', $id)
            ->firstOrFail();

        $purchase_product = DB::table('purchase_product')->where('purchase_id', $id)
            ->join('product', 'purchase_product.product_id', 'product.id')
            ->select('purchase_product.*', 'product.name as product_name')
            ->get();

        return view('buy.edit', compact('purchase_product', 'purchase'));

    }

    public function purchase_update(Request $request, $id)
    {

        $request->validate([
            'suplier_id.*' => 'required|numeric|exists:suplier,id',
            'note'         => 'nullable|string|max:255',
            'quantity'     => 'required|array|min:1',
            'quantity.*'   => 'required|numeric|gt:0',
            'cost'         => 'required|array|min:1',
            'cost.*'       => 'required|numeric|gt:0',
        ]);

        DB::table('purchase')->where('id', $id)->update([

            'suplier_id' => $request->suplier,
            'note'       => $request->note,
            'created_at' => now(),
        ]);

        $totalSum = 0;

        DB::table('purchase_product')->where('purchase_id', $id)->whereNotIn('product_id', $request->product_id)->delete();

        foreach ($request->product_id as $key => $productId) {

            $requestedQuantity = $request->quantity[$key];
            $cost              = $request->cost[$key];
            $sum               = $cost * $requestedQuantity;

            DB::table('purchase_product')->updateOrInsert(['purchase_id' => $id, 'product_id' => $productId], [
                'quantity' => $requestedQuantity,
                'cost'     => $cost,
                'sum'      => $sum,
            ]);

            $totalSum += $sum;

        }

        return redirect('buy')->with('success', 'Product updated successfully!');
    }
    //delete purchase
    public function deletePurchase($id)
    {
        DB::table('purchase')->where('id', $id)->delete();

        return redirect('buy')->with('success', 'purchase deleted successfully!');
    }

    //select2

    public function search(Request $request)
    {
        $search = $request->get('search', '');

        $products = DB::table('suplier')
            ->select('id', 'name')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->limit(10)
            ->get();

        return response()->json($products);
    }



    public function buy_index(Request $request)
    {


        if ($request->ajax()) {

            $purchases = DB::table('purchase')
            ->leftJoin('suplier', 'purchase.suplier_id', '=', 'suplier.id')
            ->select('purchase.id', 'suplier.name as suplier', 'purchase.order_number', 'purchase.discount', 'purchase.note', 'purchase.created_at');



            return DataTables::of($purchases)

                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/buy/' . $row->id . '/edit');
                    $viewUrl= url('/buy/view/' .$row->id);
                    $deleteUrl = url('/buy/' . $row->id);
                    $editLabel      = __('index.edit');
                    $deleteLabel    = __('index.delete');
                    $viewlabel = __('index.view');

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
                                <form action="' . $viewUrl . '" method="GET" style="display: inline;">
                                    <button type="submit" class="dropdown-item">' . $viewlabel . '</button>
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


        return view('buy.buy');
    }

}
