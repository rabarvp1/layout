<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class catController extends Controller
{
    public function cat(Request $request)
    {

        $cat = DB::table('cat')->get();


        return view('cat.cat', ["cat" => $cat]);
    }

    public function inputCat(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:50|unique:cat,name']);

        DB::table('cat')->insert([
            'name' => $request->name]);

        return redirect('cat');

    }

    public function cat_index(Request $request){

        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            dd(55); // Should work now
        }
        if ($request->ajax()) {

        dd(55);
            $cats = DB::table('cat')

                ->select('cat.id', 'cat.name');

            return DataTables::of($cats)

            ->filter(function ($query) use ($request) {
                if ($request->has('search') && !empty($request->input('search')['value'])) {
                    $search = $request->input('search')['value'];
                    $query->where('cat.name', 'LIKE', "%{$search}%");
                }
            })

                ->make(true);
        }
        $cat = DB::table('cat')->get();


        return view('cat.cat', ["cat" => $cat]);    }



        public function cat_edit($id){
            $cat = DB::table('cat')->where('id', $id)->firstOrFail();

            return view('cat.edit', compact('cat'));


        }
        public function cat_update(Request $request,$id){

            $request->validate([
                'name' => 'required|string|max:50|unique:cat,name']);

            DB::table('cat')->where('id',$id)->update([
                'name' => $request->name]);

            return redirect('cat');

        }
        public function cat_delete($id){

            DB::table('cat')->where('id', $id)->delete();

            return redirect('cat')->with('success', 'category deleted successfully!');


        }

}
