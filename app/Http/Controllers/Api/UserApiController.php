<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'categoryResponsibles', 'requisitions'])->get();
        return UserResource::collection($users)->additional(['success' => true]);
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());
        return (new UserResource($user->load(['roles', 'categoryResponsibles', 'requisitions'])))
            ->additional(['success' => true, 'message' => 'User created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(User $user)
    {
        return (new UserResource($user
            ->load(['roles', 'categoryResponsibles', 'requisitions'])))->additional(['success' => true]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return (new UserResource($user->load(['roles', 'categoryResponsibles', 'requisitions'])))
            ->additional(['success' => true, 'message' => 'User updated successfully.']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
    }
}
