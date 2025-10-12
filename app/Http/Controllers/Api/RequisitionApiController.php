<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequisitionCreateRequest;
use App\Http\Requests\RequisitionUpdateRequest;
use App\Http\Resources\RequisitionResource;
use App\Models\Requisition;

class RequisitionApiController extends Controller
{
    public function index()
    {
        $requisitions = Requisition::with(['user', 'category', 'subcategory', 'parent', 'children'])->get();
        return RequisitionResource::collection($requisitions)->additional(['success' => true]);
    }

    public function store(RequisitionCreateRequest $request)
    {
        $requisition = Requisition::create($request->validated());
        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Requisition created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(Requisition $requisition)
    {
        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'parent', 'children'])))->additional(['success' => true]);
    }

    public function update(RequisitionUpdateRequest $request, Requisition $requisition)
    {
        $requisition->update($request->validated());
        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Requisition updated successfully.']);
    }

    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return response()->json(['success' => true, 'message' => 'Requisition deleted successfully.']);
    }
}
