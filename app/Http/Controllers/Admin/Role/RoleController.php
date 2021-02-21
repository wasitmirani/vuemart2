<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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

        $roles=Role::where('name', 'like', '%' . $q . '%')
        ->orderBy('name','ASC')
        ->with('users')
        ->paginate(env('PER_PAGE'));
        $users=User::orderBy('name','ASC')->get();


       return response()->json(['users'=>$users,'roles'=>$roles]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:roles'],
        ]);
        $users=explode(",",$request->users);

        $user_collection=User::WhereIn('id',  $users)->get();
        // $role = Role::create(['guard_name' => ['web','api'], 'name' => $request->name]);
        $role = Role::create(['name' => $request->name]);
        $role->users()->attach($user_collection);
        // $webrole->users()->attach($user_collection);

    }






    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','unique:roles,name,'.$request->id],
        ]);
        $users=explode(",",$request->users);
        $role = Role::find($request->id);
        $role->name=$request->name;
        $role->save();
        $role->users()->sync($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Role::destroy($id);
    }
}
