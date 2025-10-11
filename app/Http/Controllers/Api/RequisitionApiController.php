<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequisitionCreateRequest;
use App\Http\Requests\RequisitionUpdateRequest;
use App\Models\Requisition;
use Illuminate\Http\Request;

class RequisitionApiController extends Controller
{
    public function index()
    {
        //
    }

    public function store(RequisitionCreateRequest $request)
    {
        //
    }

    public function show(Requisition $requisition)
    {
        //
    }

    public function update(RequisitionUpdateRequest $request, Requisition $requisition)
    {
        //
    }

    public function destroy(Requisition $requisition)
    {
        //
    }
}
