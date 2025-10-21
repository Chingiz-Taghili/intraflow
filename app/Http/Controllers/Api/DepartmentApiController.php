<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentApiController extends Controller
{
    public function index()
    {
        $departments = Department::with(['leader', 'users'])->get();
        return DepartmentResource::collection($departments)->additional(['success' => true]);
    }

    public function store(DepartmentCreateRequest $request)
    {
        $department = Department::create($request->validated());
        return (new DepartmentResource($department->load(['leader', 'users'])))
            ->additional(['success' => true, 'message' => 'Department created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Department $department)
    {
        return (new DepartmentResource($department->load(['leader', 'users'])))->additional(['success' => true]);
    }

    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $department->update($request->validated());
        return (new DepartmentResource($department->load(['leader', 'users'])))
            ->additional(['success' => true, 'message' => 'Department updated successfully']);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json(['success' => true, 'message' => 'Department deleted successfully']);
    }
}
