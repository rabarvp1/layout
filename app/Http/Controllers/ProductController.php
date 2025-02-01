<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
public function login(){


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


        return view('product.product', ['products' => $products, 'cat' => $cat,'navItems'=>$navItems]);
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
    $product = DB::table('product')->where('id', $id)->firstOrFail();
    $categories = DB::table('cat')->get();  // Get categories for the select dropdown

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
            ->select('product.id', 'product.name', 'cat.name as category');

        return DataTables::of($products)

        ->filter(function ($query) use ($request) {
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $search = $request->input('search')['value'];
                $query->where('product.name', 'LIKE', "%{$search}%");
            }
        })
            ->addColumn('actions', function ($row) {
                return '
                    <div class="d-flex gap-2 justify-content-center">
                        <form action="'.url('/product/'.$row->id.'/edit').'" method="GET">
                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                        </form>
                        <form action="'.url('/product/'.$row->id).'" method="POST"
                              onsubmit="return confirm(\'Are you sure you want to delete this product?\')">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    $cat = DB::table('cat')->get();
    return view('product.product', ['cat' => $cat]);
}



}
