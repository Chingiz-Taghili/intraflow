<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $users = User::with(['department', 'roles', 'categoryResponsibles', 'requisitions'])
            // Filters
            ->when($request->query('department_id'),
                fn($q, $departmentId) => $q->where('department_id', $departmentId))
            ->when($request->query('role'),
                fn($q, $role) => $q->whereHas('roles', fn($r) => $r->where('name', $role)))
            ->when($request->query('email_verified'), fn($q, $verified) => $verified === 'true'
                ? $q->whereNotNull('email_verified_at') : $q->whereNull('email_verified_at'))
            // Global search
            ->when($request->query('search'), fn($q, $search) => $q
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('surname', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('job_title', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                }))
            // Sort
            ->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        return view('admin.users.show');
    }

    public function edit(string $id)
    {
        return view('admin.users.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
