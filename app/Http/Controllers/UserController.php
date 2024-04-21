<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user.index')->only('index');
        $this->middleware('permission:user.create')->only('create', 'store');
        $this->middleware('permission:user.edit')->only('edit', 'update');
        $this->middleware('permission:user.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        Category::create([
            "name" => "Masuk User Page",
        ]);

        $users = User::with('roles')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $roleName = '';

        if ($request['user_type'] === 'calon-mahasiswa') {
            $roleName = 'calon-mahasiswa';
        } elseif ($request['user_type'] === 'pengawas') {
            $roleName = 'pengawas';
        } else {
            $roleName = 'admin-bidiksiba';
        }

        $role = Role::where('name', $roleName)->first();
        $user->assignRole($role);

        return redirect(route('user.index'))->with('success', 'User baru Berhasil Ditambahkan');
    }

    public function show(User $user)
    {
        //nampilkan detail satu user
    }

    public function edit(User $user)
    {
        $user->load('roles');

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }

    public function verifyEmail($id, $hash)
    {
        $user = User::findOrFail($id);

        if (sha1($user->email) !== $hash) {
            abort(404);
        }

        if (is_null($user->email_verified_at)) {
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('user.index')->with('success', 'Akun telah berhasil diverifikasi');
        } else {
            $user->email_verified_at = null;
            $user->save();

            return redirect()->route('user.index')->with('success', 'Verifikasi pada akun berhasil dihapus');
        }
    }
}
