<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequisitionImageCreateRequest;
use App\Http\Requests\RequisitionImageUpdateRequest;
use App\Http\Resources\RequisitionImageResource;
use App\Models\Requisition;
use App\Models\RequisitionImage;

class RequisitionImageApiController extends Controller
{
    public function index(Requisition $requisition)
    {
        $images = $requisition->images;
        return RequisitionImageResource::collection($images)->additional(['success' => true]);
    }

    public function store(RequisitionImageCreateRequest $request, Requisition $requisition)
    {
        $image = $requisition->images()->create($request->validated());
        return (new RequisitionImageResource($image))
            ->additional(['success' => true, 'message' => 'Image uploaded successfully.'])
            ->response()->setStatusCode(201);
    }

    public function show(Requisition $requisition, RequisitionImage $image)
    {
        if ($image->requisition_id !== $requisition->id) {
            abort(404, 'Image not found in this requisition.');
        }
        return (new RequisitionImageResource($image))->additional(['success' => true]);
    }

    public function update(
        RequisitionImageUpdateRequest $request, Requisition $requisition, RequisitionImage $image)
    {
        if ($image->requisition_id !== $requisition->id){
            abort(404, 'Image not found in this requisition.');
        }
        $image->update($request->validated());
        return (new RequisitionImageResource($image))
            ->additional(['success' => true, 'message' => 'Image updated successfully.']);
    }

    public function destroy(Requisition $requisition, RequisitionImage $image)
    {
        if ($image->requisition_id !== $requisition->id){
            abort(404, 'Image not found in this requisition.');
        }
        $image->delete();
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
