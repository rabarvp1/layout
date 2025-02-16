<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class suplierController extends Controller
{
    public function suplier()
    {

        $supliers = DB::table('suplier')->get();

        return view('suplier.suplier', ["supliers" => $supliers]);

    }
    public function inputSuplier(Request $request)
    {

        $request->validate([
            'name'         => 'required|string|max:50',
            'address'      => 'required|string|max:50',
            'phone_number' => 'required|gt:0',

        ]);

        DB::table('suplier')->insert([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('suplier');

    }

    public function edit_suplier($id)
    {

        $suplier = DB::table('suplier')->where('id', $id)->firstOrFail();

        return view('suplier.edit', compact('suplier'));

    }
    public function update_suplier(Request $request, $id)
    {

        $request->validate([
            'name'    => 'required|string|max:50',
            'address' => 'required|string|max:50',

        ]);

        DB::table('suplier')->where('id', $id)->update([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,

        ]);

        return redirect('suplier')->with('success', 'suplier updated successfully!');

    }

    public function delete_suplier($id)
    {

        DB::table('suplier')->where('id', $id)->delete();

        return redirect('suplier')->with('success', 'suplier deleted successfully!');
    }

    public function suplier_index(Request $request)
    {


        if ($request->ajax()) {

            $supliers = DB::table('suplier')
            ->select('suplier.name','suplier.id','suplier.address','suplier.phone_number')
            ->when($request->search, function ($query, $search) {
                $query->whereLike('name', "%{$search}%");

            });



            return DataTables::of($supliers)

                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/suplier/edit/' . $row->id );
                    $deleteUrl = url('/suplier/delete/' . $row->id);
                    $editLabel   = __('index.edit');
                    $deleteLabel = __('index.delete');

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


        return view('suplier.suplier');
    }





}
