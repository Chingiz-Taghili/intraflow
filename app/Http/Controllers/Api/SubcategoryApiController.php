<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoryCreateRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use App\Http\Resources\SubcategoryResource;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryApiController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return SubcategoryResource::collection($subcategories)->additional(['success' => true]);
    }

    public function store(SubcategoryCreateRequest $request)
    {
        $subcategory = Subcategory::create($request->validated());
        return (new SubcategoryResource($subcategory->load('category')))
            ->additional(['success' => true, 'message' => 'Subcategory created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Subcategory $subcategory)
    {
        return (new SubcategoryResource($subcategory->load('category')))->additional(['success' => true]);
    }

    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $subcategory->update($request->validated());
        return (new SubcategoryResource($subcategory->load('category')))
            ->additional(['success' => true, 'message' => 'Subcategory updated successfully']);
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return response()->json(['success' => true, 'message' => 'Subcategory deleted successfully']);
    }
}
