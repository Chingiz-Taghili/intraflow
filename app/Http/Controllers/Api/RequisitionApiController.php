<?php

namespace App\Http\Controllers\Api;

use App\Enums\RequisitionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequisitionCreateRequest;
use App\Http\Requests\RequisitionStatusRequest;
use App\Http\Requests\RequisitionUpdateRequest;
use App\Http\Resources\RequisitionResource;
use App\Models\Requisition;

class RequisitionApiController extends Controller
{
    public function index()
    {
        $requisitions =
            Requisition::with(['user', 'category', 'subcategory', 'images', 'reviewedBy', 'parent', 'children'])->get();
        return RequisitionResource::collection($requisitions)->additional(['success' => true]);
    }

    public function store(RequisitionCreateRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $data['status'] = $user->isLeader() ? RequisitionStatus::PENDING->value
            : RequisitionStatus::PENDING_LEADER->value;

        $requisition = Requisition::create($data);
        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'images', 'reviewedBy', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Requisition created successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(Requisition $requisition)
    {
        // policy is called
        $this->authorize('view', $requisition);

        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'images', 'reviewedBy', 'parent', 'children'])))
            ->additional(['success' => true]);
    }

    public function update(RequisitionUpdateRequest $request, Requisition $requisition)
    {
        // policy is called
        $this->authorize('update', $requisition);

        $requisition->update($request->validated());
        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'images', 'reviewedBy', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Requisition updated successfully.']);
    }

    public function destroy(Requisition $requisition)
    {
        // policy is called
        $this->authorize('delete', $requisition);

        $requisition->delete();
        return response()->json(['success' => true, 'message' => 'Requisition deleted successfully.']);
    }

    public function changeStatus(RequisitionStatusRequest $request, Requisition $requisition)
    {
        $this->authorize('changeStatus', $requisition);

        $data = $request->validated();
        if (in_array($data['status'], [
            RequisitionStatus::APPROVED_LEADER->value, RequisitionStatus::REJECTED_LEADER->value])) {
            $data['reviewed_by'] = auth()->id();
        }

        $requisition->update($data);
        return (new RequisitionResource($requisition
            ->load(['user', 'category', 'subcategory', 'images', 'reviewedBy', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Requisition status updated successfully.']);
    }
}
