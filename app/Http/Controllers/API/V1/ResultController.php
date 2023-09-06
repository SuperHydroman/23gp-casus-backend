<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultRequest;
use App\Http\Resources\ResultResource;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResultResource::collection(Result::orderBy('lap_total', 'ASC')->limit(5)->get());    // Creates a collection of all DB entries, orders them on lap time, and limits the output to 5 records from DB
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultRequest $request)
    {
        $result = Result::create($request->validated());        // Creates a new Result record for the DB if validation succeeds. If it fails, an JSON error is thrown

        return ResultResource::make($result);                   // Creates a new instance of ResultResource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
