<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve user from database using Query Builder
        $user = DB::table('users')->where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {

            return back()->with('error', __('auth.failed'));
        }

        // Manually log in the user
        Auth::loginUsingId($user->id);

        $request->session()->regenerate();
        return redirect('/');
        // return redirect()->route('first');
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('user');

        return redirect()->route('login');
    }

    public function user_index(Request $request)
    {
        if ($request->ajax()) {

            $user = DB::table('users')
                ->select('id', 'name', 'email')
                ->when($request->search, function ($query, $search) {
                    $query->whereLike('name', "%{$search}%")
                        ->orwhereLike('email', "%{$search}%");

                });

            return DataTables::of($user)

                ->addColumn('actions', function ($row) {
                    $editUrl   = url('/users/edit/' . $row->id);
                    $deleteUrl = url('/users/delete' . $row->id);

                    $editLabel      = __('index.edit');
                    $deleteLabel    = __('index.delete');
                    $confirmMessage = __('index.confirm_delete_cat');

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

        return view('login.list_users');
    }

    //-----------------Registration-----------------

    public function user_create()
    {
        $roles = DB::table('name_of_roles')->get();

        return view('login.registration', compact('roles'));
    }

    public function create(Request $request)
    {

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $userId = DB::table('users')->insertGetId([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => now(),
        ]);

        $selectedPermissions = $request->input('permission', []);

        foreach ($selectedPermissions as $permission) {
            DB::table('roles')->insert([
                'user_id' => $userId,
                'name'    => $permission,

            ]);
        }

        if ($userId) {

            return redirect('users')->with('success', 'Registration successful. Please login.');
        }

        return back()->with('error', 'Registration failed. Please try again.');
    }

    public function users()
    {

        $users = DB::table('users')->get();

        return view('login.list_users', compact('users'));
    }

    public function edit_user($id)
    {
        $user  = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('name_of_roles')->get();

        $userRoles = DB::table('roles')
            ->where('user_id', $id)
            ->pluck('name')
            ->toArray();

        if (! $user) {
            return redirect()->route('edit_user')->with('error', 'User not found.');
        }

        return view('login.edit_user', compact('user', 'roles','userRoles'));
    }

    public function update_user(Request $request, $id)
    {

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|min:6|confirmed',
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'roles'      => $request->roles,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $updated = DB::table('users')->where('id', $id)->update($data);
        if ($updated) {
            return redirect('users')->with('success', 'User updated successfully.');
        }

        return back()->with('error', 'Update failed. Please try again.');
    }

    public function delete($id)
    {
        $deleted = DB::table('users')->where('id', $id)->delete();

        if (! $deleted) {
            return redirect()->route('delete_user')->with('error', 'User not found.');
        }

        return redirect('users')->with('success', 'User deleted successfully.');
    }

}
