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

    public function cat_index(Request $request)
    {

        if ($request->ajax()) {

            // $cats = DB::table('cat')

            //     ->select('id', 'name');

            $cats = DB::table('cat')
                ->select('id', 'name')
                ->when($request->search, function ($query, $search) {
                    $query->whereLike('name', "%{$search}%");

                });

            return DataTables::of($cats)

                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/cat/edit' . $row->id );
                    $deleteUrl = url('/cat/delete' . $row->id);

                    $editLabel      = __('index.edit');
                    $deleteLabel    = __('index.delete');
                    $confirmMessage = __('index.confirm_delete_cat');

                    return '
                    <div class="dropdown text-center">
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

        return view('cat.cat');
    }

    public function cat_edit($id)
    {
        $cat = DB::table('cat')->where('id', $id)->firstOrFail();

        return view('cat.edit', compact('cat'));

    }
    public function cat_update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:50']);

        DB::table('cat')->where('id', $id)->update([
            'name' => $request->name]);

        return redirect('cat');

    }
    public function cat_delete($id)
    {

        DB::table('cat')->where('id', $id)->delete();

        return redirect('cat')->with('success', 'category deleted successfully!');

    }

}
