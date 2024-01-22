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
        //index -> menampilkan tabel data
        Category::create([
            "name" => "Masuk User Page",
        ]);

        // mengambil data
        // $users = DB::table('users')
        //     ->when($request->input('name'), function ($query, $name) {
        //         return $query->where('name', 'like', '%' . $name . '%');
        //     })
        $users = User::with('roles') // Eager load the 'roles' relationship
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->input('roles'), function ($query, $roles) {
                // The $roles parameter is an array of selected roles
                // Filter users based on the selected roles
                return $query->whereHas('roles', function (Builder $query) use ($roles) {
                    $query->whereIn('name', $roles);
                });
            })
            ->select('id', 'name', 'email', DB::raw("DATE_FORMAT(created_at, '%d %M %Y') as created_at"))
            ->select('id', 'name', 'email', DB::raw("DATE_FORMAT(users.email_verified_at, '%d %M %Y') as email_verified_at"))
            ->paginate(10);
        // return view('users.index', compact('users'));
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        // halaman tambah user
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        //simpan data
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $roleName = 'calon-mahasiswa';
        $role = Role::where('name', $roleName)->first();
        $user->assignRole($role);

        return redirect(route('user.index'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(User $user)
    {
        //nampilkan detail satu user
    }

    public function edit(User $user)
    {
        // return view('users.edit')
        //     ->with('user', $user);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //mengupdate data user ke database
        // $validate = $request->validated();
        $validatedData = $request->validated();
        $user->update($validatedData);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        // $user->update($validate);
        // return redirect()->route('user.index')->with('success', 'User Berhasil Diupdate');
        return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    }

    public function destroy(User $user)
    {
        //delete data
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }

    public function export()
    {
        // export data ke excel
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        // import excel ke data tables
        $users = Excel::toCollection(new UsersImport, $request->import_file);
        foreach ($users[0] as $user) {
            User::where('id', $user[0])->update([
                'name' => $user[1],
                'email' => $user[2],
                'password' => $user[3],
            ]);
        }
        return redirect()->route('user.index');
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

            return redirect()->route('user.index')->with('success', 'Email verified successfully');
        } else {
            $user->email_verified_at = null;
            $user->save();

            return redirect()->route('user.index')->with('success', 'Email verification deleted successfully');
        }
    }

    public function view(User $user)
    {
        // Load any additional data related to the user if needed
        return view('users.view', compact('user'));
    }
}
