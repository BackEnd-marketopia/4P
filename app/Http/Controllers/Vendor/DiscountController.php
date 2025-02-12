<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Discount\StoreDiscountRequest;
use App\Http\Requests\Vendor\Discount\UpdateDiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $image = Helpers::addImage($request->image, 'discount');
        Discount::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
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
    public function update(UpdateDiscountRequest $request, string $id)
    {
        $discount = Discount::where('id', $id)
            ->where('vendor_id', auth('web')->user()->vendor->id)->first();

        if ($request->image) {
            if (File::exists($discount->image)) {
                File::delete($discount->image);
            }
            $image = Helpers::addImage($request->image, 'discount');
        }
        $discount->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image ?? $discount->image,
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
