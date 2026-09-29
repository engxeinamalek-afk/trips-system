<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use App\Http\Requests\UpdateStatusRequest;

class CityController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        $validatedData= $request->validated();
        $city= City::create(['name' => $validatedData['name'],
                            'is_active' => true]);
        return $this->success($city,
                            'City created successfully!',
                            201 );
    }

    public function updateStatus(UpdateStatusRequest $request, City $city)
    {
        $city->update($request->validated());
        return $this->success($city,
                              'City updated successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
