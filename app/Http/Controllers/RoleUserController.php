<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manage_users');
        $users = User::where('role','customer')->get();
        $roles = Role::all();
        return view('admin.all_users_roles')->with('roles', $roles ?? null)->with('users',$users ?? null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|unique:users,email',
            'password'=> 'required|min:3',
            'phone'=> 'required',
            'role'=> 'required',
       ]);
        $user = User::create([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'=>'admin',
            'verified_at'=> now(),
        ]);
        Admin::create([
            "first_name" => request()->first_name, 
            "last_name" => request()->last_name, 
            "phone_number" => request()->phone,
            "user_id"=> $user->id
        ]);

        $user->assignRole($request->role);
        return redirect('/users_roles')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        $roles = Role::all();
        $user_roles = $user->roles;
        return view('admin.edit_users_roles')->with('user',$user)->with('roles',$roles)->with('user_roles',$user_roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required',
            'password'=> 'required|min:3',
            'phone'=> 'required',
            'role'=> 'required',
       ]);
        $user->update([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'=>'admin',
            'verified_at'=> now(),
        ]);
        $user->admin->update([
            "first_name" => request()->first_name, 
            "last_name" => request()->last_name, 
            "phone_number" => request()->phone,
            "user_id"=> $user->id
        ]);
        $user->assignRole($request->role);
        return redirect('/users_roles')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
