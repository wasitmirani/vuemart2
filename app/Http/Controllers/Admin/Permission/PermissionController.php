<?php

namespace App\Http\Controllers\Admin\Permission;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $q=request('query');
        $permissions=Permission::where('name', 'like', '%' .$q. '%')
        ->orderBy('name','ASC')
        ->with('roles')->paginate(env('PAR_PAGE'));
        $roles=Role::orderBy('name','ASC')->get();
        return response()->json(['permissions'=>$permissions,'roles'=>$roles]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:permissions'],
        ]);
        $roles=explode(",",$request->roles);
        $role_collection=Role::WhereIn('id',  $roles)->get();
        $permission = Permission::create(['name' => $request->name]);
        $permission->syncRoles($role_collection);
        }





    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:permissions,name,'.$request->id],
        ]);
        $roles=explode(",",$request->roles);

        $permission = Permission::find($request->id);
        $permission->name=$request->name;
        $permission->save();
        $permission->roles()->sync($roles);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);
        //
    }
}
