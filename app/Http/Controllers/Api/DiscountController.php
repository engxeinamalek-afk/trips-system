<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
Use App\Http\Requests\UpdateDiscountRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Discount;
class DiscountController extends ApiBaseController
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
    public function store(StoreDiscountRequest $request)
    {
        $validatedData= $request->validated();
        $discount= Discount::create(['name' => $validatedData['name'],
                                  'regular_percentage' => $validatedData['regular_percentage'],
                                  'vip_percentage' => $validatedData['vip_percentage'],
                                  'is_active' => true]);
        return $this->success($discount,
                            'Discount created successfully!',
                            201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->update($request->validated());
        return $this->success($discount,
                            'Discount updated successfully!');
        
    }

    public function updateStatus(UpdateStatusRequest $request, Discount $discount){
        $data= $request->validated();
        $discount->update(['is_active' => $data['is_active']]);
        return $this->success($discount,
                            'Discount updated successfully!');       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
