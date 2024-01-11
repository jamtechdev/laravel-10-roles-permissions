<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::all();
        return view('permission.index',compact('permissions'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name'
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('message', 'Add Permission Successfully');
    }

    public function edit($id)
    {
        $permissionid = Permission::find($id);
        return view('permission.edit',compact('permissionid'));
    }

    public function update(Request $request)
    {
        $permission = Permission::find($request->permission_id);
        $permission->name = $request->name;
        $permission->save();
        return redirect()->route('permissions.index')->with('message', 'Update Permission Successfully');
    }

    public function destroy($id)
    {
        $permissionid = Permission::find($id);
        $permissionid->delete();
        return redirect()->route('permissions.index')->with('message', 'Delete Permission Successfully');

    }
}
