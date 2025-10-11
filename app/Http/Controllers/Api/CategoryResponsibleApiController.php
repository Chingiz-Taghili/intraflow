<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryResponsibleCreateRequest;
use App\Http\Requests\CategoryResponsibleUpdateRequest;
use App\Http\Resources\CategoryResponsibleResource;
use App\Models\CategoryResponsible;
use Illuminate\Http\Request;

class CategoryResponsibleApiController extends Controller
{
    public function index()
    {
        $responsibles = CategoryResponsible::with(['user', 'category', 'assignedBy'])->get();
        return CategoryResponsibleResource::collection($responsibles)->additional(['success' => true]);
    }

    public function store(CategoryResponsibleCreateRequest $request)
    {
        $responsible = CategoryResponsible::create($request->validated());
        $responsible->load('user', 'category', 'assignedBy');
        return (new CategoryResponsibleResource($responsible))
            ->additional(['success' => true, 'message' => 'Category responsible created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(CategoryResponsible $responsible)
    {
        $responsible->load(['user', 'category', 'assignedBy']);
        return (new CategoryResponsibleResource($responsible))->additional(['success' => true]);
    }

    public function update(CategoryResponsibleUpdateRequest $request, CategoryResponsible $responsible)
    {
        $responsible->update($request->validated());
        $responsible->load(['user', 'category', 'assignedBy']);
        return (new CategoryResponsibleResource($responsible))
            ->additional(['success' => true, 'message' => 'Category responsible updated successfully.']);
    }

    public function destroy(CategoryResponsible $responsible)
    {
        $responsible->delete();
        return response()->json(['success' => true, 'message' => 'Category responsible deleted successfully.']);
    }
}
