<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // |exists:product,cat_id

        DB::table('product')->insert([
            'name'   => $request->name,
            'cat_id' => $request->cat_id,
        ]);

        return redirect('product');

    }

//   this method for delete product

    public function deleteProduct($id)
{
    // Delete the product by id using Query Builder
    DB::table('product')->where('id', $id)->delete();

    // Redirect back to the product page with a success message
    return redirect('product')->with('success', 'Product deleted successfully!');
}

//this method for edit product page

public function editProduct($id)
{
    $product = DB::table('product')->where('id', $id)->first();
    $categories = DB::table('cat')->get();  // Get categories for the select dropdown

    return view('product.edit', compact('product', 'categories'));
}

//this method for updating product

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




}
