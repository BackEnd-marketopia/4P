<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vendor\StoreVendorRequest;
use App\Http\Requests\Admin\Vendor\UpdateVendorRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type', 'vendor')->paginate(10);
        return view('admin.vendor.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $cities = City::all();
        $categories = Category::all();
        return view('admin.vendor.create', compact('cities', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        $image = $request->image ? Helpers::addImage($request->image, 'user') : null;

        $logo = Helpers::addImage($request->logo, 'logo');
        $cover = Helpers::addImage($request->cover, 'cover');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image ?? null,
            'user_type' => 'vendor',
            'status' => 'active',
            'city_id' => $request->city_ids[0],
        ]);

        $cities = json_encode($request->city_ids);

        Vendor::create([
            'name' => $request->name_of_brand,
            'logo' => $logo,
            'cover' => $cover,
            'description' => $request->description,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'address' => $request->address,
            'status' => $request->status,
            'google_map_link' => $request->google_map_link ?? null,
            'citys_id' => $cities,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.vendors.index')->with('success', __('message.Vendor Added Successfully'));
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
        $user = User::findOrFail($id);
        $cities = City::all();
        $categories = Category::all();
        $cities_id = $user->vendor->citys_id;

        return view('admin.vendor.edit', compact('user', 'cities', 'categories', 'cities_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $image = $request->image ? Helpers::addImage($request->image, 'user') : $user->image;

        $logo = $request->logo ? Helpers::addImage($request->logo, 'logo') : $user->vendor->logo;
        $cover = $request->cover ? Helpers::addImage($request->cover, 'cover') : $user->vendor->cover;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'image' => $image ?? null,
            'user_type' => 'vendor',
            'status' => $request->status_of_account,
            'city_id' => $request->city_ids[0],
        ]);

        $cities = json_encode($request->city_ids);

        $user->vendor->update([
            'name' => $request->name_of_brand,
            'logo' => $logo,
            'cover' => $cover,
            'description' => $request->description,
            'whatsapp' => $request->whatsapp ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'address' => $request->address,
            'status' => $request->status,
            'google_map_link' => $request->google_map_link ?? null,
            'citys_id' => $cities,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.vendors.index')->with('success', __('message.Vendor Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.vendors.index')->with('success', __('message.Vendor Deleted Successfully'));
    }
}
