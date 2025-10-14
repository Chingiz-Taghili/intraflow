<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function register(ApiRegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_photo' => $validated['profile_photo'] ?? null,
            'job_title' => $validated['job_title'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return (new UserResource($user))->additional([
            'success' => true, 'message' => 'User registered successfully.',
            'token' => $token,])->response()->setStatusCode(201);
    }

    public function login(ApiLoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;

        return (new UserResource($user))->additional(['success' => true,
            'message' => 'Login successful.', 'token' => $token,]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logout successful.',]);
    }

    public function me(Request $request)
    {
        return (new UserResource($request->user()))->additional(['success' => true]);
    }
}
