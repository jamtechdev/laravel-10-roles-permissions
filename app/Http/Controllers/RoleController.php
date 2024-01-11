<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roles =  Role::where('name', '!=', 'superadmin')->get();

        return view('role.index',compact('roles'));
    }

    public function create()
    {   
        
        $permissions = Permission::all();

        return view('role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = new Role();

        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('roles.index')->with('message','add role successfully');

    }

    public function show($id)
    {
        $roles = Role::find($id);
        $rolePermissions = $roles->permissions;

        return view('role.show', compact('roles', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('role.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $roleid = $request->role_id;
        $update = Role::find($roleid);
        $update->name = $request->name;
        $update->save();

        $update->syncPermissions($request->permission);

        return redirect()->route('roles.index')->with('message', 'update role successfully');
    }
    
    public function destroy($id)
    {
        $roleid = Role::find($id);

        $roleid->delete();

        return redirect()->route('roles.index')->with('message','delete user successfully');

    }
}
