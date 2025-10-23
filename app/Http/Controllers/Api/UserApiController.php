<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::with(['department', 'roles', 'categoryResponsibles', 'requisitions'])->get();
        return UserResource::collection($users)->additional(['success' => true]);
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('user');
        return (new UserResource($user->load(['department', 'roles', 'categoryResponsibles', 'requisitions'])))
            ->additional(['success' => true, 'message' => 'User created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(User $user)
    {
        return (new UserResource($user->load([
            'department', 'roles', 'categoryResponsibles', 'requisitions'])))->additional(['success' => true]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // policy is called
        $this->authorize('update', $user);

        $user->update($request->validated());
        return (new UserResource($user->load(['department', 'roles', 'categoryResponsibles', 'requisitions'])))
            ->additional(['success' => true, 'message' => 'User updated successfully.']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }

    public function assignRole(User $user, Role $role)
    {
        if ($user->email === env('SUPERADMIN_EMAIL')) {
            return response()->json(['success' => false,
                'message' => 'Root superadmin role cannot be modified.'], 403);
        }
        $user->assignRole($role);
        return response()->json(['success' => true,
            'message' => 'Role assigned to user successfully.', 'data' => $user->getRoleNames()]);
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->email === env('SUPERADMIN_EMAIL')) {
            return response()->json(['success' => false,
                'message' => 'Root superadmin role cannot be modified.'], 403);
        }
        $user->removeRole($role);
        return response()->json(['success' => true,
            'message' => 'Role removed from user successfully.', 'data' => $user->getRoleNames()]);
    }
}
