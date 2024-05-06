<?php

namespace App\Http\Controllers\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission.index')->only('index');
        $this->middleware('permission:permission.create')->only('create', 'store');
        $this->middleware('permission:permission.edit')->only('edit', 'update');
        $this->middleware('permission:permission.destroy')->only('destroy');
    }
    public function index(Request $request)
    {
        //
        $permissions = DB::table('permissions')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->input('guard_name'), function ($query, $guard_name) {
                return $query->where('guard_name', 'like', '%' . $guard_name . '%');
            })
            ->paginate(10);
        return view('permissions.permissions.index', compact('permissions'));
    }

    public function create()
    {
        //
        return view('permissions.permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        //
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web',
        ]);
        return redirect()->route('permission.index')->with('success', 'Permission baru berhasil ditambahkan');
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        //
        return view('permissions.permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //
        $permission->update($request->validated());
        return redirect()->route('permission.index')->with('success', 'Data Permission berhasil diperbarui');
    }

    public function destroy(Permission $permission)
    {
        //
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Permission berhasil dihapus');
    }
}
