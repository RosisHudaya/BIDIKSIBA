<?php

namespace App\Http\Controllers\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignRequest;
use App\Http\Requests\StoreUserToRoleRequest;
use App\Http\Requests\UpdateAssignRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\DuplicateMethodException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignPermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:assign.index')->only('index');
        $this->middleware('permission:assign.create')->only('create', 'store');
        $this->middleware('permission:assign.edit')->only('edit', 'update');
        $this->middleware('permission:assign.destroy')->only('destroy');
    }
    public function index()
    {
        //
        $roles = Role::with('permissions')->paginate(10);
        return view('permissions.assign.index', compact('roles'));
    }
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('permissions.assign.create', compact('roles', 'permissions'));
    }

    public function store(StoreUserToRoleRequest $request)
    {
        $role = Role::find($request->role);
        $role->givePermissionTo($request->permissions);
        return redirect()->route('assign.index')->with('success', 'Permission Assigned Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        //
        $roles = Role::all();
        $permissions = Permission::all();
        return view('permissions.assign.edit', compact('role', 'roles', 'permissions'));
    }

    public function update(UpdateAssignRequest $request, Role $role)
    {
        $role->syncPermissions($request->permissions);
        return redirect()->route('assign.index')->with('success', 'Data Assign to Permission berhasil diperbarui');
    }

    public function destroy($id)
    {
        //
    }
}
