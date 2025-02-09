<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function login()
    {

        return view('login.login');

    }

    public function product()
    {

        $products = DB::table('product')
            ->join('cat', 'cat.id', 'product.cat_id')
            ->select(
                'product.*',
                'cat.name as category',
            )
            ->get();

        $cat = DB::table('cat')->get();

        $navItems = [
            ['label' => 'Back', 'url' => url('/'), 'active' => false],
        ];

        return view('product.product', ['products' => $products, 'cat' => $cat, 'navItems' => $navItems]);
    }

    public function upload(Request $request)
    {

        $request->validate([
            'name'   => 'required|string|max:50|unique:product,name',
            'cat_id' => 'required|numeric|exists:cat,id',
        ]);

        DB::table('product')->insert([
            'name'   => $request->name,
            'cat_id' => $request->cat_id,
        ]);

        return redirect('product');

    }

    public function deleteProduct($id)
    {
        DB::table('product')->where('id', $id)->delete();

        return redirect('product')->with('success', 'Product deleted successfully!');
    }

    public function editProduct($id)
    {
        $product    = DB::table('product')->where('id', $id)->firstOrFail();
        $categories = DB::table('cat')->get(); // Get categories for the select dropdown

        return view('product.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:50|unique:product,name,' . $id,
            'cat_id' => 'required|numeric|exists:cat,id',
        ]);

        DB::table('product')->where('id', $id)->update([
            'name'   => $request->name,
            'cat_id' => $request->cat_id,
        ]);

        return redirect('product')->with('success', 'Product updated successfully!');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $products = DB::table('product')
                ->join('cat', 'product.cat_id', '=', 'cat.id')
                ->select('product.id', 'product.name', 'cat.name as category')
                ->when($request->search, function ($query, $search) {
                    $query->whereLike('product.name', "%{$search}%")
                    ->orWhereLike('cat.name', "%{$search}%");

                });

            return DataTables::of($products)
                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/product/' . $row->id . '/edit');
                    $deleteUrl = url('/product/' . $row->id);

                    $editLabel      = __('index.edit');
                    $deleteLabel    = __('index.delete');
                    $confirmMessage = __('index.confirm_delete_product');

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

        $cat = DB::table('cat')->get();
        return view('product.product', ['cat' => $cat]);
    }
    public function search_cat(Request $request)
    {
        $search = $request->get('search', '');

        $cats = DB::table('cat')
            ->select('id', 'name')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->limit(10)
            ->get();

        return response()->json($cats);
    }

}
