<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryCreateRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use App\Http\Resources\SubcategoryResource;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryApiController extends Controller
{
    public function index(Category $category)
    {
        $subcategories = $category->subcategories;
        return SubcategoryResource::collection($subcategories)->additional(['success' => true]);
    }

    public function store(SubcategoryCreateRequest $request, Category $category)
    {
        $subcategory = $category->subcategories()->create($request->validated());
        return (new SubcategoryResource($subcategory))
            ->additional(['success' => true, 'message' => 'Subcategory created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(Category $category, Subcategory $subcategory)
    {
        if ($subcategory->category_id !== $category->id) {
            abort(404, 'Subcategory not found in this requisition.');
        }
        return (new SubcategoryResource($subcategory))->additional(['success' => true]);
    }

    public function update(SubcategoryUpdateRequest $request, Category $category, Subcategory $subcategory)
    {
        if ($subcategory->category_id !== $category->id) {
            abort(404, 'Subcategory not found in this requisition.');
        }
        $subcategory->update($request->validated());
        return (new SubcategoryResource($subcategory))
            ->additional(['success' => true, 'message' => 'Subcategory updated successfully']);
    }

    public function destroy(Category $category, Subcategory $subcategory)
    {
        if ($subcategory->category_id !== $category->id) {
            abort(404, 'Subcategory not found in this requisition.');
        }
        $subcategory->delete();
        return response()->json(['success' => true, 'message' => 'Subcategory deleted successfully']);
    }
}
