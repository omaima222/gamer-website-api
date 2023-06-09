<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\RoleRequest;
use GuzzleHttp\Promise\Create;
use App\Http\Resources\roleResource;

class RoleController extends Controller
{
 
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index()
    {
        $roles=Role::with('permissions')->get();
        return response()->json([
            'message'=>'All the roles :',
            'Roles'=> roleResource::collection($roles),
        ]);
    }
  
    public function store(RoleRequest $request)
    {
        $role=Role::create($request->all());
        $role->permissions()->attach($request->permission_id);
        return response()->json([
            'message'=>'Role added succesfully',
        ]);
    }

    public function show(Role $role)
    {
        return response()->json([
            'message'=>'the role you are looking for :',
            'Role'=> new roleResource($role),
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->permission_id);
        return response()->json([
            'message'=>'Role updated succesfully',
        ]);
    }

    public function destroy(Role $role)
    {
        Role::destroy($role->id);
        return response()->json([
            'message'=>'Role deleted succesfully',
        ]);
    }
}
