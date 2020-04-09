<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name' => 'required',
        ]);
        if (Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ])) {
            flash()->success('User role was successfully added!.');
        } else {
            flash()->error('User role could not be added!.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        // display the roles with their permissions;
        return view('roles.show')->with(compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = config('permissions');
        $rolePermissions = $role->getAllPermissions()->pluck('name')->toArray();
        return view('roles.edit')->with(compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if ($role->update([
            'name' => $request->input('name'),
        ])) {
            $role->syncPermissions($request->input('permissions'));

            flash()->success('User role was successfully updated!');
        } else {
            flash()->error('User role could not be updated!');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        // if nobody is attached to the role
        // delete it.
        if ($role->delete()) {
            flash()->success('Role was successfully deleted!');
        } else {
            flash()->error('Role could not be deleted. Please try again later');
        }
        return back();
    }
}
