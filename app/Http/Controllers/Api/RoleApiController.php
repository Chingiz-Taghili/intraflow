<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleApiController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::with('users')->get())->additional(['success' => true]);
    }

    public function store(RoleCreateRequest $request)
    {
        $role = Role::create($request->validated());
        return (new RoleResource($role->load('users')))
            ->additional(['success' => true, 'message' => 'Role created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(Role $role)
    {
        return (new RoleResource($role->load('users')))->additional(['success' => true]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update($request->validated());
        return (new RoleResource($role->load('users')))
            ->additional(['success' => true, 'message' => 'Role updated successfully.']);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
    }
}
