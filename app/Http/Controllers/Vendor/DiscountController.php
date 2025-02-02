<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Discount\StoreDiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::where('vendor_id', auth('web')->user()->vendor->id)->paginate(10);
        return view('vendor.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        Discount::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'vendor_id' => auth('web')->user()->vendor->id,
        ]);
        return redirect()->route('vendor.discounts.index')->with('success', __('message.Discount Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $discount = Discount::where('id', $id)
            ->where('vendor_id', auth('web')->user()->vendor->id)->first();
        return view('vendor.discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDiscountRequest $request, string $id)
    {
        $discount = Discount::where('id', $id)
            ->where('vendor_id', auth('web')->user()->vendor->id)->first();
        $discount->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'vendor_id' => auth('web')->user()->vendor->id,
        ]);
        return redirect()->route('vendor.discounts.index')->with('success', __('message.Discount Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = Discount::where('id', $id)
            ->where('vendor_id', auth('web')->user()->vendor->id)->first();

        $discount->delete();

        return redirect()->route('vendor.discounts.index')->with('success', __('message.Discount Deleted Successfully'));
    }
}
