<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Resources\permissionResource;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Permission::class, 'permission');
    }

    public function index()
    {
        $permissions=Permission::get();
        return response()->json([
            'message'=>'All the permissions :',
            'Permissions'=> permissionResource::collection($permissions),
        ]);
    }

    public function show(Permission $permission)
    {
        return response()->json([
            'message'=>'the permission you are looking for :',
            'Permissions'=> new permissionResource($permission),
        ]);
    }

    public function store(PermissionRequest $request){
        Permission::create($request->all());
        return response()->json([
            'message'=>'Permission added succesfully',
        ]);
    }

    
    public function destroy(Permission $permission){
        Permission::destroy($permission->id);
        return response()->json([
            'message'=>'Permission deleted succesfully',
        ]);
    }
}
